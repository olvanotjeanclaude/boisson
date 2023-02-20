<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nIrTqJWEeCb3QcnB',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7wV0HiRDrQ5OkY71',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/category-articles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Afkttaf3kEJOPX8m',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7SK2OVybU6lRotAf',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uK4O1ByCIQtOiqHd',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BUu5iUEnh4fzTgXu',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/reset' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.request',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.email',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/confirm' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Jqltf9axavcSibEN',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/utilisateurs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.utilisateurs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.utilisateurs.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/utilisateurs/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.utilisateurs.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-get-utilisateurs-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.utilisateurs.ajaxGetData',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-post-utilisateurs-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.utilisateurs.ajaxPostData',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/fournisseurs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.fournisseurs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.fournisseurs.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/fournisseurs/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.fournisseurs.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-get-fournisseurs-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.fournisseurs.ajaxGetData',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-post-fournisseurs-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.fournisseurs.ajaxPostData',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/achat-produits' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-produits.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-produits.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/achat-produits/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-produits.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-get-achat-produits-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-produits.ajaxGetData',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-post-achat-produits-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-produits.ajaxPostData',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/tarif-fournisseurs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tarif-fournisseurs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tarif-fournisseurs.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/tarif-fournisseurs/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tarif-fournisseurs.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-get-tarif-fournisseurs-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tarif-fournisseurs.ajaxGetData',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-post-tarif-fournisseurs-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tarif-fournisseurs.ajaxPostData',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dashboard/detail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard.detail',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dashboard/export-detail-excel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard.exportExcel',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dashboard/detail-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard.detailData',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dashboard/facture/impression' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard.printReport',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dashboard/facture/telecharger' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard.download',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/articles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.articles.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.articles.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/articles/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.articles.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-get-articles-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.articles.ajaxGetData',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-post-articles-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.articles.ajaxPostData',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/category-articles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.category-articles.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.category-articles.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/category-articles/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.category-articles.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-get-category-articles-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.category-articles.ajaxGetData',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-post-category-articles-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.category-articles.ajaxPostData',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/produits/articles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.articles.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.articles.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/produits/articles/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.articles.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/produits/ajax-get-articles-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.articles.ajaxGetData',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/produits/ajax-post-articles-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.articles.ajaxPostData',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/produits/get-articles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.articles.getData',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/produits/emballages' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.emballages.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.emballages.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/produits/emballages/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.emballages.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/produits/ajax-get-emballages-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.emballages.ajaxGetData',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/produits/ajax-post-emballages-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.emballages.ajaxPostData',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/pre-save-articles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.article.preSaveArticle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/pre-save-invoice-articles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.article.preSaveInvoiceArticle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/stocks' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.stocks.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.stocks.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/stocks/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.stocks.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-get-stocks-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.stocks.ajaxGetData',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-post-stocks-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.stocks.ajaxPostData',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/get-stock-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.stocks.getData',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/print-report-stock' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.stocks.printReport',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/etat-emballages' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.etat-emballages.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/etat-emballages/imprimer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.etat-emballages.printReport',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/inventaires' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.inventaires.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/inventaires/get-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.inventaires.ajaxGetData',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/inventaires/imprimer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.inventaires.print',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/inventaires/telecharger' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.inventaires.download',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/inventaires/check-stock' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.inventaires.checkStock',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/inventaires/demmande-ajustement-de-stock' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.inventaires.adjustStockRequest',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.settings.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ventes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.ventes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.ventes.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ventes/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.ventes.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-get-ventes-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.ventes.ajaxGetData',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-post-ventes-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.ventes.ajaxPostData',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/impression-vente' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sale.print',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/download-vente' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sale.download',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/clients' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.clients.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.clients.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/clients/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.clients.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-get-clients-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.clients.ajaxGetData',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-post-clients-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.clients.ajaxPostData',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/get-customers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.customer.getData',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/sorti-stocks' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sorti-stocks.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sorti-stocks.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/sorti-stocks/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sorti-stocks.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-get-sorti-stocks-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sorti-stocks.ajaxGetData',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-post-sorti-stocks-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sorti-stocks.ajaxPostData',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/change-mot-de-passe' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.password.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.profile.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.profile.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/profile/edit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.profile.edit',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/home' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/achat-fournisseurs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-fournisseurs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-fournisseurs.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/achat-fournisseurs/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-fournisseurs.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-get-achat-fournisseurs-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-fournisseurs.ajaxGetData',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/ajax-post-achat-fournisseurs-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-fournisseurs.ajaxPostData',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/clear_cache' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bqJ5RyXbfQ4G4cjs',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reset' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ic0ztJJ70tBpRg2N',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/sync-user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BxFZBk2d61SHPiZM',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/desactivate-account' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'desactivate-account.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'desactivate-account.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/a(?|pi/(?|get\\-article(?|s/([^/]++)(*:43)|/([^/]++)(*:59))|supplier/([^/]++)/articles(*:93))|dmin/(?|utilisateurs/([^/]++)(?|(*:133)|/edit(*:146)|(*:154))|fournisseurs/([^/]++)(?|(*:187)|/edit(*:200)|(*:208))|a(?|chat\\-produits/([^/]++)(?|(*:247)|/edit(*:260)|(*:268))|rticles/([^/]++)(?|(*:296)|/edit(*:309)|(*:317)))|tarif\\-fournisseurs/([^/]++)(?|/edit(*:363)|(*:371))|category\\-articles/([^/]++)(?|/edit(*:415)|(*:423))|produits/(?|articles/([^/]++)(?|/edit(*:469)|(*:477))|emballages/([^/]++)(?|/edit(*:513)|(*:521)))|stocks/([^/]++)(?|(*:549)|/edit(*:562)|(*:570))|i(?|nventaires/ajustement\\-de\\-stock/([^/]++)(?|(*:627))|mpression/(?|vente/([^/]++)(?|(*:666)|/(?|preview(*:685)|te(?|lecharger(*:707)|rminer(*:721))|annuler(*:737)))|achat/([^/]++)(?|(*:764)|/(?|te(?|rminer(*:787)|lecharger(*:804))|preview(*:820)))))|([^/]++)/detail/([^/]++)(?|(*:859)|/print(*:873))|ventes/(?|([^/]++)(?|(*:903)|/edit(*:916)|(*:924))|payment/([^/]++)(?|(*:952)))|clients/([^/]++)(?|(*:981)|/edit(*:994)|(*:1002))|sorti\\-stocks/([^/]++)(?|(*:1037)|/(?|edit(*:1054)|imprimer(*:1071)|telecharger(*:1091)|valid(*:1105)|annuler(*:1121))|(*:1131))|achat\\-(?|fournisseurs/(?|([^/]++)(?|(*:1178)|/edit(*:1192)|(*:1201))|achat\\-fournisseurs(?|/([^/]++)/(?|print(*:1251)|telecharger(*:1271)|cancel(*:1286))|\\-auto(*:1302)))|produits/payment/([^/]++)(?|(*:1341)))))|/password/reset/([^/]++)(*:1378)|/connect\\-using\\-email/([^/]++)(*:1418))/?$}sDu',
    ),
    3 => 
    array (
      43 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IJu3goggn5jt4y9A',
          ),
          1 => 
          array (
            0 => 'type',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      59 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2UWwrb21N6X1KMNK',
          ),
          1 => 
          array (
            0 => 'article_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      93 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.getArticleBySupplier',
          ),
          1 => 
          array (
            0 => 'supplier_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      133 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.utilisateurs.show',
          ),
          1 => 
          array (
            0 => 'utilisateur',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      146 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.utilisateurs.edit',
          ),
          1 => 
          array (
            0 => 'utilisateur',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      154 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.utilisateurs.update',
          ),
          1 => 
          array (
            0 => 'utilisateur',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.utilisateurs.destroy',
          ),
          1 => 
          array (
            0 => 'utilisateur',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      187 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.fournisseurs.show',
          ),
          1 => 
          array (
            0 => 'fournisseur',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      200 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.fournisseurs.edit',
          ),
          1 => 
          array (
            0 => 'fournisseur',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      208 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.fournisseurs.update',
          ),
          1 => 
          array (
            0 => 'fournisseur',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.fournisseurs.destroy',
          ),
          1 => 
          array (
            0 => 'fournisseur',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      247 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-produits.show',
          ),
          1 => 
          array (
            0 => 'achat_produit',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      260 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-produits.edit',
          ),
          1 => 
          array (
            0 => 'achat_produit',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      268 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-produits.update',
          ),
          1 => 
          array (
            0 => 'achat_produit',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-produits.destroy',
          ),
          1 => 
          array (
            0 => 'achat_produit',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      296 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.articles.show',
          ),
          1 => 
          array (
            0 => 'article',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      309 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.articles.edit',
          ),
          1 => 
          array (
            0 => 'article',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      317 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.articles.update',
          ),
          1 => 
          array (
            0 => 'article',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.articles.destroy',
          ),
          1 => 
          array (
            0 => 'article',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      363 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tarif-fournisseurs.edit',
          ),
          1 => 
          array (
            0 => 'tarif_fournisseur',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      371 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tarif-fournisseurs.update',
          ),
          1 => 
          array (
            0 => 'tarif_fournisseur',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tarif-fournisseurs.destroy',
          ),
          1 => 
          array (
            0 => 'tarif_fournisseur',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      415 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.category-articles.edit',
          ),
          1 => 
          array (
            0 => 'category_article',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      423 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.category-articles.update',
          ),
          1 => 
          array (
            0 => 'category_article',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.category-articles.destroy',
          ),
          1 => 
          array (
            0 => 'category_article',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      469 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.articles.edit',
          ),
          1 => 
          array (
            0 => 'article',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      477 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.articles.update',
          ),
          1 => 
          array (
            0 => 'article',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.articles.destroy',
          ),
          1 => 
          array (
            0 => 'article',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      513 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.emballages.edit',
          ),
          1 => 
          array (
            0 => 'emballage',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      521 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.emballages.update',
          ),
          1 => 
          array (
            0 => 'emballage',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.approvisionnement.emballages.destroy',
          ),
          1 => 
          array (
            0 => 'emballage',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      549 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.stocks.show',
          ),
          1 => 
          array (
            0 => 'stock',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      562 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.stocks.edit',
          ),
          1 => 
          array (
            0 => 'stock',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      570 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.stocks.update',
          ),
          1 => 
          array (
            0 => 'stock',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.stocks.destroy',
          ),
          1 => 
          array (
            0 => 'stock',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      627 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.inventaires.getAdjustStockForm',
          ),
          1 => 
          array (
            0 => 'inventory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.inventaires.adjustStock',
          ),
          1 => 
          array (
            0 => 'inventory',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      666 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.print.sale',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      685 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.print.sale.preview',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      707 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.print.sale.download',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      721 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.print.sale.terminate',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      737 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.print.sale.cancel',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      764 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.print.achat',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      787 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.print.achat.terminate',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      804 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.print.achat.download',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      820 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.print.achat.preview',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      859 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.document.show',
          ),
          1 => 
          array (
            0 => 'type',
            1 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      873 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.document.print',
          ),
          1 => 
          array (
            0 => 'type',
            1 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      903 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.ventes.show',
          ),
          1 => 
          array (
            0 => 'vente',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      916 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.ventes.edit',
          ),
          1 => 
          array (
            0 => 'vente',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      924 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.ventes.update',
          ),
          1 => 
          array (
            0 => 'vente',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.ventes.destroy',
          ),
          1 => 
          array (
            0 => 'vente',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      952 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sale.paymentForm',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sale.paymentStore',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      981 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.clients.show',
          ),
          1 => 
          array (
            0 => 'client',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      994 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.clients.edit',
          ),
          1 => 
          array (
            0 => 'client',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1002 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.clients.update',
          ),
          1 => 
          array (
            0 => 'client',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.clients.destroy',
          ),
          1 => 
          array (
            0 => 'client',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1037 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sorti-stocks.show',
          ),
          1 => 
          array (
            0 => 'sorti_stock',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1054 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sorti-stocks.edit',
          ),
          1 => 
          array (
            0 => 'sorti_stock',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1071 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sorti-stocks.print',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1091 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sorti-stocks.download',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1105 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sorti-stocks.validStockOut',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1121 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sorti-stocks.cancel',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1131 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sorti-stocks.update',
          ),
          1 => 
          array (
            0 => 'sorti_stock',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sorti-stocks.destroy',
          ),
          1 => 
          array (
            0 => 'sorti_stock',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1178 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-fournisseurs.show',
          ),
          1 => 
          array (
            0 => 'achat_fournisseur',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1192 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-fournisseurs.edit',
          ),
          1 => 
          array (
            0 => 'achat_fournisseur',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1201 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-fournisseurs.update',
          ),
          1 => 
          array (
            0 => 'achat_fournisseur',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-fournisseurs.destroy',
          ),
          1 => 
          array (
            0 => 'achat_fournisseur',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1251 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-fournisseurs.print',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1271 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-fournisseurs.download',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1286 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-fournisseurs.cancel',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1302 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat-fournisseurs.saveAutoStock',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1341 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat.paymentForm',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.achat.paymentStore',
          ),
          1 => 
          array (
            0 => 'invoice_number',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1378 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1418 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fySCdO6kGZpKF2uh',
          ),
          1 => 
          array (
            0 => 'email',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'generated::nIrTqJWEeCb3QcnB' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'generated::nIrTqJWEeCb3QcnB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7wV0HiRDrQ5OkY71' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'api',
          2 => 'auth:sanctum',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:297:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:79:"function (\\Illuminate\\Http\\Request $request) {
    return $request->user();
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000003866f1fe0000000015fff4f5";}";s:4:"hash";s:44:"QBWWAZDPWJvpXoYCOLeUoiEw95JNQynGrWizjoR+Jnc=";}}',
        'namespace' => NULL,
        'prefix' => '/api',
        'where' => 
        array (
        ),
        'as' => 'generated::7wV0HiRDrQ5OkY71',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Afkttaf3kEJOPX8m' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/category-articles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@allCategories',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@allCategories',
        'namespace' => NULL,
        'prefix' => '/api',
        'where' => 
        array (
        ),
        'as' => 'generated::Afkttaf3kEJOPX8m',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IJu3goggn5jt4y9A' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/get-articles/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\article\\ArticleController@index',
        'controller' => 'App\\Http\\Controllers\\api\\article\\ArticleController@index',
        'namespace' => NULL,
        'prefix' => '/api',
        'where' => 
        array (
        ),
        'as' => 'generated::IJu3goggn5jt4y9A',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2UWwrb21N6X1KMNK' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/get-article/{article_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\article\\ArticleController@show',
        'controller' => 'App\\Http\\Controllers\\api\\article\\ArticleController@show',
        'namespace' => NULL,
        'prefix' => '/api',
        'where' => 
        array (
        ),
        'as' => 'generated::2UWwrb21N6X1KMNK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.getArticleBySupplier' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/supplier/{supplier_id}/articles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\api\\article\\ArticleController@getArticleBySupplier',
        'controller' => 'App\\Http\\Controllers\\api\\article\\ArticleController@getArticleBySupplier',
        'namespace' => NULL,
        'prefix' => '/api',
        'where' => 
        array (
        ),
        'as' => 'api.getArticleBySupplier',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7SK2OVybU6lRotAf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\RedirectController@__invoke',
        'controller' => '\\Illuminate\\Routing\\RedirectController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::7SK2OVybU6lRotAf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'destination' => '/admin',
        'status' => 302,
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uK4O1ByCIQtOiqHd' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::uK4O1ByCIQtOiqHd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'register',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BUu5iUEnh4fzTgXu' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::BUu5iUEnh4fzTgXu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.request' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.request',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.email' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.email',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Jqltf9axavcSibEN' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Jqltf9axavcSibEN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.utilisateurs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/utilisateurs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.utilisateurs.index',
        'uses' => 'App\\Http\\Controllers\\admin\\users\\UserController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\users\\UserController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.utilisateurs.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/utilisateurs/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.utilisateurs.create',
        'uses' => 'App\\Http\\Controllers\\admin\\users\\UserController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\users\\UserController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.utilisateurs.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/utilisateurs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.utilisateurs.store',
        'uses' => 'App\\Http\\Controllers\\admin\\users\\UserController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\users\\UserController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.utilisateurs.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/utilisateurs/{utilisateur}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.utilisateurs.show',
        'uses' => 'App\\Http\\Controllers\\admin\\users\\UserController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\users\\UserController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.utilisateurs.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/utilisateurs/{utilisateur}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.utilisateurs.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\users\\UserController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\users\\UserController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.utilisateurs.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/utilisateurs/{utilisateur}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.utilisateurs.update',
        'uses' => 'App\\Http\\Controllers\\admin\\users\\UserController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\users\\UserController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.utilisateurs.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/utilisateurs/{utilisateur}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.utilisateurs.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\users\\UserController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\users\\UserController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.utilisateurs.ajaxGetData' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ajax-get-utilisateurs-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.utilisateurs.ajaxGetData',
        'uses' => 'App\\Http\\Controllers\\admin\\users\\UserController@ajaxGetData',
        'controller' => 'App\\Http\\Controllers\\admin\\users\\UserController@ajaxGetData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.utilisateurs.ajaxPostData' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ajax-post-utilisateurs-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.utilisateurs.ajaxPostData',
        'uses' => 'App\\Http\\Controllers\\admin\\users\\UserController@ajaxPostData',
        'controller' => 'App\\Http\\Controllers\\admin\\users\\UserController@ajaxPostData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.fournisseurs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/fournisseurs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.fournisseurs.index',
        'uses' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.fournisseurs.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/fournisseurs/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.fournisseurs.create',
        'uses' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.fournisseurs.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/fournisseurs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.fournisseurs.store',
        'uses' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.fournisseurs.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/fournisseurs/{fournisseur}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.fournisseurs.show',
        'uses' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.fournisseurs.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/fournisseurs/{fournisseur}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.fournisseurs.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.fournisseurs.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/fournisseurs/{fournisseur}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.fournisseurs.update',
        'uses' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.fournisseurs.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/fournisseurs/{fournisseur}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.fournisseurs.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.fournisseurs.ajaxGetData' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ajax-get-fournisseurs-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.fournisseurs.ajaxGetData',
        'uses' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@ajaxGetData',
        'controller' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@ajaxGetData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.fournisseurs.ajaxPostData' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ajax-post-fournisseurs-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.fournisseurs.ajaxPostData',
        'uses' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@ajaxPostData',
        'controller' => 'App\\Http\\Controllers\\admin\\supplier\\SupplierController@ajaxPostData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-produits.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/achat-produits',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.achat-produits.index',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-produits.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/achat-produits/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.achat-produits.create',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-produits.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/achat-produits',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.achat-produits.store',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-produits.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/achat-produits/{achat_produit}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.achat-produits.show',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-produits.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/achat-produits/{achat_produit}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.achat-produits.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-produits.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/achat-produits/{achat_produit}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.achat-produits.update',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-produits.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/achat-produits/{achat_produit}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.achat-produits.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-produits.ajaxGetData' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ajax-get-achat-produits-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.achat-produits.ajaxGetData',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@ajaxGetData',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@ajaxGetData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-produits.ajaxPostData' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ajax-post-achat-produits-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.achat-produits.ajaxPostData',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@ajaxPostData',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\PurchaseProductController@ajaxPostData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tarif-fournisseurs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/tarif-fournisseurs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.tarif-fournisseurs.index',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\PricingSupplierController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\PricingSupplierController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tarif-fournisseurs.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/tarif-fournisseurs/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.tarif-fournisseurs.create',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\PricingSupplierController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\PricingSupplierController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tarif-fournisseurs.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/tarif-fournisseurs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.tarif-fournisseurs.store',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\PricingSupplierController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\PricingSupplierController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tarif-fournisseurs.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/tarif-fournisseurs/{tarif_fournisseur}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.tarif-fournisseurs.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\PricingSupplierController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\PricingSupplierController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tarif-fournisseurs.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/tarif-fournisseurs/{tarif_fournisseur}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.tarif-fournisseurs.update',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\PricingSupplierController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\PricingSupplierController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tarif-fournisseurs.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/tarif-fournisseurs/{tarif_fournisseur}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.tarif-fournisseurs.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\PricingSupplierController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\PricingSupplierController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tarif-fournisseurs.ajaxGetData' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ajax-get-tarif-fournisseurs-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.tarif-fournisseurs.ajaxGetData',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\PricingSupplierController@ajaxGetData',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\PricingSupplierController@ajaxGetData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tarif-fournisseurs.ajaxPostData' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ajax-post-tarif-fournisseurs-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view all',
        ),
        'as' => 'admin.tarif-fournisseurs.ajaxPostData',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\PricingSupplierController@ajaxPostData',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\PricingSupplierController@ajaxPostData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\AdminController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\AdminController@index',
        'as' => 'admin.index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard.detail' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dashboard/detail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\AdminController@detail',
        'controller' => 'App\\Http\\Controllers\\admin\\AdminController@detail',
        'as' => 'admin.dashboard.detail',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard.exportExcel' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dashboard/export-detail-excel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\AdminController@exportExcel',
        'controller' => 'App\\Http\\Controllers\\admin\\AdminController@exportExcel',
        'as' => 'admin.dashboard.exportExcel',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard.detailData' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dashboard/detail-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\AdminController@detailData',
        'controller' => 'App\\Http\\Controllers\\admin\\AdminController@detailData',
        'as' => 'admin.dashboard.detailData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard.printReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dashboard/facture/impression',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view dashboard',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\AdminController@printReport',
        'controller' => 'App\\Http\\Controllers\\admin\\AdminController@printReport',
        'as' => 'admin.dashboard.printReport',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard.download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dashboard/facture/telecharger',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view dashboard',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\AdminController@download',
        'controller' => 'App\\Http\\Controllers\\admin\\AdminController@download',
        'as' => 'admin.dashboard.download',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.articles.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/articles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.articles.index',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.articles.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/articles/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.articles.create',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.articles.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/articles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.articles.store',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.articles.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/articles/{article}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.articles.show',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.articles.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/articles/{article}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.articles.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.articles.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/articles/{article}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.articles.update',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.articles.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/articles/{article}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.articles.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.articles.ajaxGetData' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ajax-get-articles-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.articles.ajaxGetData',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@ajaxGetData',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@ajaxGetData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.articles.ajaxPostData' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ajax-post-articles-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.articles.ajaxPostData',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@ajaxPostData',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@ajaxPostData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.category-articles.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/category-articles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.category-articles.index',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.category-articles.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/category-articles/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.category-articles.create',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.category-articles.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/category-articles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.category-articles.store',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.category-articles.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/category-articles/{category_article}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.category-articles.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.category-articles.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/category-articles/{category_article}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.category-articles.update',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.category-articles.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/category-articles/{category_article}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.category-articles.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.category-articles.ajaxGetData' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ajax-get-category-articles-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.category-articles.ajaxGetData',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@ajaxGetData',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@ajaxGetData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.category-articles.ajaxPostData' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ajax-post-category-articles-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.category-articles.ajaxPostData',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@ajaxPostData',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\CategoryArticleController@ajaxPostData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.articles.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/produits/articles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.approvisionnement.articles.index',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@index',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.articles.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/produits/articles/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.approvisionnement.articles.create',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@create',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.articles.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/produits/articles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.approvisionnement.articles.store',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@store',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.articles.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/produits/articles/{article}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.approvisionnement.articles.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.articles.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/produits/articles/{article}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.approvisionnement.articles.update',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@update',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.articles.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/produits/articles/{article}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.approvisionnement.articles.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.articles.ajaxGetData' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/produits/ajax-get-articles-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.approvisionnement.articles.ajaxGetData',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@ajaxGetData',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@ajaxGetData',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.articles.ajaxPostData' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/produits/ajax-post-articles-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.approvisionnement.articles.ajaxPostData',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@ajaxPostData',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@ajaxPostData',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.articles.getData' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/produits/get-articles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@getData',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\ProductController@getData',
        'as' => 'admin.approvisionnement.articles.getData',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.emballages.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/produits/emballages',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.approvisionnement.emballages.index',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\EmballageController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\EmballageController@index',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.emballages.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/produits/emballages/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.approvisionnement.emballages.create',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\EmballageController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\EmballageController@create',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.emballages.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/produits/emballages',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.approvisionnement.emballages.store',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\EmballageController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\EmballageController@store',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.emballages.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/produits/emballages/{emballage}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.approvisionnement.emballages.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\EmballageController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\EmballageController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.emballages.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/produits/emballages/{emballage}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.approvisionnement.emballages.update',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\EmballageController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\EmballageController@update',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.emballages.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/produits/emballages/{emballage}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.approvisionnement.emballages.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\EmballageController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\EmballageController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.emballages.ajaxGetData' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/produits/ajax-get-emballages-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.approvisionnement.emballages.ajaxGetData',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\EmballageController@ajaxGetData',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\EmballageController@ajaxGetData',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.approvisionnement.emballages.ajaxPostData' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/produits/ajax-post-emballages-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view article',
        ),
        'as' => 'admin.approvisionnement.emballages.ajaxPostData',
        'uses' => 'App\\Http\\Controllers\\admin\\produit\\EmballageController@ajaxPostData',
        'controller' => 'App\\Http\\Controllers\\admin\\produit\\EmballageController@ajaxPostData',
        'namespace' => NULL,
        'prefix' => 'admin/produits',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.article.preSaveArticle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/pre-save-articles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@preSaveArticle',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@preSaveArticle',
        'as' => 'admin.article.preSaveArticle',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.article.preSaveInvoiceArticle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/pre-save-invoice-articles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@preSaveInvoiceArticle',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\ArticleController@preSaveInvoiceArticle',
        'as' => 'admin.article.preSaveInvoiceArticle',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.stocks.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/stocks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view stock',
        ),
        'as' => 'admin.stocks.index',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.stocks.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/stocks/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view stock',
        ),
        'as' => 'admin.stocks.create',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.stocks.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/stocks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view stock',
        ),
        'as' => 'admin.stocks.store',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.stocks.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/stocks/{stock}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view stock',
        ),
        'as' => 'admin.stocks.show',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.stocks.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/stocks/{stock}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view stock',
        ),
        'as' => 'admin.stocks.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.stocks.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/stocks/{stock}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view stock',
        ),
        'as' => 'admin.stocks.update',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.stocks.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/stocks/{stock}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view stock',
        ),
        'as' => 'admin.stocks.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.stocks.ajaxGetData' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ajax-get-stocks-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view stock',
        ),
        'as' => 'admin.stocks.ajaxGetData',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockController@ajaxGetData',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockController@ajaxGetData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.stocks.ajaxPostData' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ajax-post-stocks-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view stock',
        ),
        'as' => 'admin.stocks.ajaxPostData',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockController@ajaxPostData',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockController@ajaxPostData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.stocks.getData' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/get-stock-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view stock',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockController@getData',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockController@getData',
        'as' => 'admin.stocks.getData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.stocks.printReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/print-report-stock',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view stock',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockController@printReport',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockController@printReport',
        'as' => 'admin.stocks.printReport',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.etat-emballages.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/etat-emballages',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view stock',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\EtatEmballageController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\EtatEmballageController@index',
        'as' => 'admin.etat-emballages.index',
        'namespace' => NULL,
        'prefix' => 'admin/etat-emballages',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.etat-emballages.printReport' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/etat-emballages/imprimer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view stock',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\EtatEmballageController@printReport',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\EtatEmballageController@printReport',
        'as' => 'admin.etat-emballages.printReport',
        'namespace' => NULL,
        'prefix' => 'admin/etat-emballages',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.inventaires.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/inventaires',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view inventory',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\InventoryController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\InventoryController@index',
        'as' => 'admin.inventaires.index',
        'namespace' => NULL,
        'prefix' => 'admin/inventaires',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.inventaires.ajaxGetData' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/inventaires/get-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view inventory',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\InventoryController@ajaxGetData',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\InventoryController@ajaxGetData',
        'as' => 'admin.inventaires.ajaxGetData',
        'namespace' => NULL,
        'prefix' => 'admin/inventaires',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.inventaires.print' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/inventaires/imprimer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view inventory',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\InventoryController@print',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\InventoryController@print',
        'as' => 'admin.inventaires.print',
        'namespace' => NULL,
        'prefix' => 'admin/inventaires',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.inventaires.download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/inventaires/telecharger',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view inventory',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\InventoryController@download',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\InventoryController@download',
        'as' => 'admin.inventaires.download',
        'namespace' => NULL,
        'prefix' => 'admin/inventaires',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.inventaires.checkStock' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/inventaires/check-stock',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view inventory',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\InventoryController@checkStock',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\InventoryController@checkStock',
        'as' => 'admin.inventaires.checkStock',
        'namespace' => NULL,
        'prefix' => 'admin/inventaires',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.inventaires.getAdjustStockForm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/inventaires/ajustement-de-stock/{inventory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view inventory',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\InventoryController@getAdjustStockForm',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\InventoryController@getAdjustStockForm',
        'as' => 'admin.inventaires.getAdjustStockForm',
        'namespace' => NULL,
        'prefix' => 'admin/inventaires',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.inventaires.adjustStockRequest' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/inventaires/demmande-ajustement-de-stock',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view inventory',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\InventoryController@adjustStockRequest',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\InventoryController@adjustStockRequest',
        'as' => 'admin.inventaires.adjustStockRequest',
        'namespace' => NULL,
        'prefix' => 'admin/inventaires',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.inventaires.adjustStock' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/inventaires/ajustement-de-stock/{inventory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view inventory',
          5 => 'can:valid inventory',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\InventoryController@adjustStock',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\InventoryController@adjustStock',
        'as' => 'admin.inventaires.adjustStock',
        'namespace' => NULL,
        'prefix' => 'admin/inventaires',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.settings.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\settings\\SettingController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\settings\\SettingController@update',
        'as' => 'admin.settings.update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.print.sale' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/impression/vente/{invoice_number}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@printSale',
        'controller' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@printSale',
        'as' => 'admin.print.sale',
        'namespace' => NULL,
        'prefix' => 'admin/impression',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.print.sale.preview' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/impression/vente/{invoice_number}/preview',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@previewSale',
        'controller' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@previewSale',
        'as' => 'admin.print.sale.preview',
        'namespace' => NULL,
        'prefix' => 'admin/impression',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.print.sale.download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/impression/vente/{invoice_number}/telecharger',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@downloadSale',
        'controller' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@downloadSale',
        'as' => 'admin.print.sale.download',
        'namespace' => NULL,
        'prefix' => 'admin/impression',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.print.sale.cancel' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/impression/vente/{invoice_number}/annuler',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:cancel sales',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@cancelSale',
        'controller' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@cancelSale',
        'as' => 'admin.print.sale.cancel',
        'namespace' => NULL,
        'prefix' => 'admin/impression',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.print.sale.terminate' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/impression/vente/{invoice_number}/terminer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@saleTerminate',
        'controller' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@saleTerminate',
        'as' => 'admin.print.sale.terminate',
        'namespace' => NULL,
        'prefix' => 'admin/impression',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.print.achat' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/impression/achat/{invoice_number}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@printAchat',
        'controller' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@printAchat',
        'as' => 'admin.print.achat',
        'namespace' => NULL,
        'prefix' => 'admin/impression',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.print.achat.terminate' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/impression/achat/{invoice_number}/terminer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@achatTerminate',
        'controller' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@achatTerminate',
        'as' => 'admin.print.achat.terminate',
        'namespace' => NULL,
        'prefix' => 'admin/impression',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.print.achat.preview' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/impression/achat/{invoice_number}/preview',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@previewAchat',
        'controller' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@previewAchat',
        'as' => 'admin.print.achat.preview',
        'namespace' => NULL,
        'prefix' => 'admin/impression',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.print.achat.download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/impression/achat/{invoice_number}/telecharger',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@downloadAchat',
        'controller' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@downloadAchat',
        'as' => 'admin.print.achat.download',
        'namespace' => NULL,
        'prefix' => 'admin/impression',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.document.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/{type}/detail/{invoice_number}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@show',
        'as' => 'admin.document.show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.document.print' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/{type}/detail/{invoice_number}/print',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@print',
        'controller' => 'App\\Http\\Controllers\\admin\\impression\\ImpressionController@print',
        'as' => 'admin.document.print',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.ventes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ventes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.ventes.index',
        'uses' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.ventes.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ventes/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.ventes.create',
        'uses' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.ventes.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ventes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.ventes.store',
        'uses' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.ventes.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ventes/{vente}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.ventes.show',
        'uses' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.ventes.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ventes/{vente}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.ventes.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.ventes.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/ventes/{vente}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.ventes.update',
        'uses' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.ventes.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/ventes/{vente}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.ventes.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.ventes.ajaxGetData' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ajax-get-ventes-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.ventes.ajaxGetData',
        'uses' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@ajaxGetData',
        'controller' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@ajaxGetData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.ventes.ajaxPostData' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ajax-post-ventes-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.ventes.ajaxPostData',
        'uses' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@ajaxPostData',
        'controller' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@ajaxPostData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sale.print' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/impression-vente',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@print',
        'controller' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@print',
        'as' => 'admin.sale.print',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sale.download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/download-vente',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@download',
        'controller' => 'App\\Http\\Controllers\\admin\\sale\\SaleController@download',
        'as' => 'admin.sale.download',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sale.paymentForm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ventes/payment/{invoice_number}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:make payment',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\payment\\PaymentController@paymentForm',
        'controller' => 'App\\Http\\Controllers\\admin\\payment\\PaymentController@paymentForm',
        'as' => 'admin.sale.paymentForm',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sale.paymentStore' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ventes/payment/{invoice_number}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:make payment',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\payment\\PaymentController@paymentStore',
        'controller' => 'App\\Http\\Controllers\\admin\\payment\\PaymentController@paymentStore',
        'as' => 'admin.sale.paymentStore',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.clients.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/clients',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.clients.index',
        'uses' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.clients.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/clients/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.clients.create',
        'uses' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.clients.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/clients',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.clients.store',
        'uses' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.clients.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/clients/{client}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.clients.show',
        'uses' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.clients.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/clients/{client}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.clients.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.clients.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/clients/{client}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.clients.update',
        'uses' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.clients.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/clients/{client}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.clients.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.clients.ajaxGetData' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ajax-get-clients-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.clients.ajaxGetData',
        'uses' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@ajaxGetData',
        'controller' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@ajaxGetData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.clients.ajaxPostData' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ajax-post-clients-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'as' => 'admin.clients.ajaxPostData',
        'uses' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@ajaxPostData',
        'controller' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@ajaxPostData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.customer.getData' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/get-customers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@getData',
        'controller' => 'App\\Http\\Controllers\\admin\\customer\\CustomerController@getData',
        'as' => 'admin.customer.getData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sorti-stocks.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/sorti-stocks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view_intern_doc',
        ),
        'as' => 'admin.sorti-stocks.index',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sorti-stocks.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/sorti-stocks/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view_intern_doc',
        ),
        'as' => 'admin.sorti-stocks.create',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sorti-stocks.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/sorti-stocks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view_intern_doc',
        ),
        'as' => 'admin.sorti-stocks.store',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sorti-stocks.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/sorti-stocks/{sorti_stock}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view_intern_doc',
        ),
        'as' => 'admin.sorti-stocks.show',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sorti-stocks.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/sorti-stocks/{sorti_stock}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view_intern_doc',
        ),
        'as' => 'admin.sorti-stocks.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sorti-stocks.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/sorti-stocks/{sorti_stock}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view_intern_doc',
        ),
        'as' => 'admin.sorti-stocks.update',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sorti-stocks.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/sorti-stocks/{sorti_stock}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view_intern_doc',
        ),
        'as' => 'admin.sorti-stocks.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sorti-stocks.ajaxGetData' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ajax-get-sorti-stocks-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view_intern_doc',
        ),
        'as' => 'admin.sorti-stocks.ajaxGetData',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@ajaxGetData',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@ajaxGetData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sorti-stocks.ajaxPostData' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ajax-post-sorti-stocks-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view_intern_doc',
        ),
        'as' => 'admin.sorti-stocks.ajaxPostData',
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@ajaxPostData',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@ajaxPostData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sorti-stocks.print' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/sorti-stocks/{invoice_number}/imprimer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view_intern_doc',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@print',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@print',
        'as' => 'admin.sorti-stocks.print',
        'namespace' => NULL,
        'prefix' => 'admin/sorti-stocks/{invoice_number}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sorti-stocks.download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/sorti-stocks/{invoice_number}/telecharger',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view_intern_doc',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@download',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@download',
        'as' => 'admin.sorti-stocks.download',
        'namespace' => NULL,
        'prefix' => 'admin/sorti-stocks/{invoice_number}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sorti-stocks.validStockOut' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/sorti-stocks/{invoice_number}/valid',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view_intern_doc',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@validStockOut',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@validStockOut',
        'as' => 'admin.sorti-stocks.validStockOut',
        'namespace' => NULL,
        'prefix' => 'admin/sorti-stocks/{invoice_number}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sorti-stocks.cancel' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/sorti-stocks/{invoice_number}/annuler',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
          4 => 'can:view_intern_doc',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@cancel',
        'controller' => 'App\\Http\\Controllers\\admin\\article\\StockOutController@cancel',
        'as' => 'admin.sorti-stocks.cancel',
        'namespace' => NULL,
        'prefix' => 'admin/sorti-stocks/{invoice_number}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.password.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/change-mot-de-passe',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\password\\PasswordController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\password\\PasswordController@index',
        'as' => 'admin.password.index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.password.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/change-mot-de-passe',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\password\\PasswordController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\password\\PasswordController@update',
        'as' => 'admin.password.update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.profile.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\profile\\ProfileController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\profile\\ProfileController@index',
        'as' => 'admin.profile.index',
        'namespace' => 'profile',
        'prefix' => 'admin/profile',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.profile.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/profile/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\profile\\ProfileController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\profile\\ProfileController@edit',
        'as' => 'admin.profile.edit',
        'namespace' => 'profile',
        'prefix' => 'admin/profile',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.profile.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'auth',
          3 => 'CheckUserValidityMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\profile\\ProfileController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\profile\\ProfileController@update',
        'as' => 'admin.profile.update',
        'namespace' => 'profile',
        'prefix' => 'admin/profile',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'home',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@index',
        'controller' => 'App\\Http\\Controllers\\HomeController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'home',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-fournisseurs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/achat-fournisseurs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'can:view_intern_doc',
        ),
        'as' => 'admin.achat-fournisseurs.index',
        'uses' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@index',
        'controller' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-fournisseurs.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/achat-fournisseurs/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'can:view_intern_doc',
        ),
        'as' => 'admin.achat-fournisseurs.create',
        'uses' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@create',
        'controller' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-fournisseurs.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/achat-fournisseurs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'can:view_intern_doc',
        ),
        'as' => 'admin.achat-fournisseurs.store',
        'uses' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@store',
        'controller' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-fournisseurs.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/achat-fournisseurs/{achat_fournisseur}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'can:view_intern_doc',
        ),
        'as' => 'admin.achat-fournisseurs.show',
        'uses' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@show',
        'controller' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-fournisseurs.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/achat-fournisseurs/{achat_fournisseur}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'can:view_intern_doc',
        ),
        'as' => 'admin.achat-fournisseurs.edit',
        'uses' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@edit',
        'controller' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-fournisseurs.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/achat-fournisseurs/{achat_fournisseur}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'can:view_intern_doc',
        ),
        'as' => 'admin.achat-fournisseurs.update',
        'uses' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@update',
        'controller' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-fournisseurs.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/achat-fournisseurs/{achat_fournisseur}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'can:view_intern_doc',
        ),
        'as' => 'admin.achat-fournisseurs.destroy',
        'uses' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@destroy',
        'controller' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-fournisseurs.ajaxGetData' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/ajax-get-achat-fournisseurs-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'can:view_intern_doc',
        ),
        'as' => 'admin.achat-fournisseurs.ajaxGetData',
        'uses' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@ajaxGetData',
        'controller' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@ajaxGetData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-fournisseurs.ajaxPostData' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/ajax-post-achat-fournisseurs-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'can:view_intern_doc',
        ),
        'as' => 'admin.achat-fournisseurs.ajaxPostData',
        'uses' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@ajaxPostData',
        'controller' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@ajaxPostData',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-fournisseurs.print' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/achat-fournisseurs/achat-fournisseurs/{invoice_number}/print',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'can:view_intern_doc',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@print',
        'controller' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@print',
        'as' => 'admin.achat-fournisseurs.print',
        'namespace' => NULL,
        'prefix' => 'admin/achat-fournisseurs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-fournisseurs.download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/achat-fournisseurs/achat-fournisseurs/{invoice_number}/telecharger',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'can:view_intern_doc',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@download',
        'controller' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@download',
        'as' => 'admin.achat-fournisseurs.download',
        'namespace' => NULL,
        'prefix' => 'admin/achat-fournisseurs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-fournisseurs.cancel' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/achat-fournisseurs/achat-fournisseurs/{invoice_number}/cancel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'can:view_intern_doc',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@cancel',
        'controller' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@cancel',
        'as' => 'admin.achat-fournisseurs.cancel',
        'namespace' => NULL,
        'prefix' => 'admin/achat-fournisseurs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat-fournisseurs.saveAutoStock' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/achat-fournisseurs/achat-fournisseurs-auto',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'can:view_intern_doc',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@saveAutoStock',
        'controller' => 'App\\Http\\Controllers\\admin\\achat\\AchatFournisseurController@saveAutoStock',
        'as' => 'admin.achat-fournisseurs.saveAutoStock',
        'namespace' => NULL,
        'prefix' => 'admin/achat-fournisseurs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat.paymentForm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/achat-produits/payment/{invoice_number}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'can:view_intern_doc',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\payment\\PaymentController@achatPaymentForm',
        'controller' => 'App\\Http\\Controllers\\admin\\payment\\PaymentController@achatPaymentForm',
        'as' => 'admin.achat.paymentForm',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.achat.paymentStore' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/achat-produits/payment/{invoice_number}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
          2 => 'can:view_intern_doc',
        ),
        'uses' => 'App\\Http\\Controllers\\admin\\payment\\PaymentController@achatPaymentStore',
        'controller' => 'App\\Http\\Controllers\\admin\\payment\\PaymentController@achatPaymentStore',
        'as' => 'admin.achat.paymentStore',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bqJ5RyXbfQ4G4cjs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'clear_cache',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\QuickAdminController@clearCache',
        'controller' => 'App\\Http\\Controllers\\QuickAdminController@clearCache',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::bqJ5RyXbfQ4G4cjs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ic0ztJJ70tBpRg2N' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\QuickAdminController@resetDatabase',
        'controller' => 'App\\Http\\Controllers\\QuickAdminController@resetDatabase',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ic0ztJJ70tBpRg2N',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BxFZBk2d61SHPiZM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sync-user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\QuickAdminController@syncUser',
        'controller' => 'App\\Http\\Controllers\\QuickAdminController@syncUser',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::BxFZBk2d61SHPiZM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'desactivate-account.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'desactivate-account',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'as' => 'desactivate-account.index',
        'uses' => 'App\\Http\\Controllers\\DisableAccountController@index',
        'controller' => 'App\\Http\\Controllers\\DisableAccountController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'desactivate-account.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'desactivate-account',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'as' => 'desactivate-account.store',
        'uses' => 'App\\Http\\Controllers\\DisableAccountController@store',
        'controller' => 'App\\Http\\Controllers\\DisableAccountController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fySCdO6kGZpKF2uh' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'connect-using-email/{email}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'ModeDevMiddleware',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\AutoLoginController@connectWithEmail',
        'controller' => 'App\\Http\\Controllers\\Auth\\AutoLoginController@connectWithEmail',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::fySCdO6kGZpKF2uh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
