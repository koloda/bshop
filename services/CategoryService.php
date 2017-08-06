<?php

namespace app\services;

use app\models\Category;
use app\models\Product;

/**
* Category service class
* Contains all additional category functionality to get tiny Category model
*/
class CategoryService extends BaseModelService
{
    use traits\Url;
    private static $urlBase = 'category';
    private static $productsPerPage = 4;

    /**
    * @param Category
    * @return \yii\db\ActiveQuery
    */
    public function getProducts($category)
    {
        return $category->hasMany(Product::className(), ['category_id' => 'id']);
    }

    public static function getPaginatedProducts($category, $page=1)
    {
        $CI = &get_instance();
        $perPage = self::$productsPerPage;
        $query = self::getProducts($category);
        $countQuery = clone $query;
        $models = $query->offset(($page-1)*$perPage)
            ->limit($perPage)
            ->all();

        $CI->load->library('pagination');

        $config['base_url'] = self::getUrl($category);
        $config['total_rows'] = $countQuery->count();
        $config['per_page'] = $perPage;
        $config['use_page_numbers'] = true;
        $config['query_string_segment'] = 'page';

        $paginationConfig['full_tag_open'] = '<ul class="b-pagination">';
        $paginationConfig['full_tag_close'] = '</ul>';

        /* First page */
        $paginationConfig['first_tag_open'] = '<li class="b-pagination__item b-pagination_first">';
        $paginationConfig['first_link'] = '1...';
        $paginationConfig['first_tag_close'] = '</li>';

        /* Previous page */
        $paginationConfig['prev_tag_open'] = '<li class="b-pagination__item b-pagination_prev">';
        $paginationConfig['prev_link'] = '<i class="b-pagination__arrow fa fa-angle-left fa-2x"></i>';
        $paginationConfig['prev_tag_close'] = '</li>';

        /* Page number */
        $paginationConfig['num_tag_open'] = '<li class="b-pagination__item b-pagination_page">';
        $paginationConfig['num_tag_close'] = '</li>';

        /* Page number active */
        $paginationConfig['cur_tag_open'] = '<li class="b-pagination__item b-pagination_page"><span class="b-pagination_page-active">';
        $paginationConfig['cur_tag_close'] = '</span></li>';

        /* Next page */
        $paginationConfig['next_tag_open'] = '<li class="b-pagination__item b-pagination_next">';
        $paginationConfig['next_link'] = '<i class="b-pagination__arrow fa fa-angle-right fa-2x"></i>';
        $paginationConfig['next_tag_close'] = '</li>';

        /* Last page */
        $paginationConfig['last_tag_open'] = '<li class="b-pagination__item b-pagination_last">';
        $paginationConfig['last_link'] = '... '.$paginationConfig['total_rows'];
        $paginationConfig['last_tag_close'] = '</li>';


        /* Configuration */
        $paginationConfig['num_links'] = 2;
        $paginationConfig['page_query_string'] = true;

        $config = array_merge($paginationConfig, $config);

        $CI->pagination->initialize($config);

        return [
            'models' => $models,
            'pagination' => $CI->pagination->create_links()
        ];
    }
}