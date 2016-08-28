<?php

use Illuminate\Database\Seeder;


class MenuSeed extends Seeder
{
    /* example add menu
        \webarq::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Management product',
                'controller'    => '#',
                'slug'          => 'product',
                'order'         => 1,
            ],[]);

                \webarq::addMenu([ 
                    'parent_id'     => 'product',
                    'title'         => 'Category',
                    'controller'    => 'CategoryController',
                    'slug'          => 'category',
                    'order'         => '1'
                ],['index','create','update','delete']
            ); 

    */
   

         
    public function run()
    {
        \helper::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Page',
                'controller'    => '#',
                'slug'          => 'news',
                'order'         => 1,
            ],[]);

        \helper::addMenu([ 
                    'parent_id'     => 'news',
                    'title'         => 'News Update',
                    'controller'    => 'Page\NewsController',
                    'slug'          => 'news-update',
                    'order'         => '1'
                ],['index','create','update','delete']
        ); 
        
        // master menu
        \helper::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Master',
                'controller'    => '#',
                'slug'          => 'master',
                'order'         => 1,
            ],[]);

        \helper::addMenu([ 
                    'parent_id'     => 'master',
                    'title'         => 'Data Penelitian',
                    'controller'    => 'Master\PenelitianController',
                    'slug'          => 'data-penelitian',
                    'order'         => '1'
                ],['index','create','update','delete']
        ); 
    }
}
