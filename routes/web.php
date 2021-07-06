<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//--------------- Auntenticar
Route::get('/login', [
    'as' => 'auth.login',
    'uses' => 'AuthController@login'
]);

Route::post('/login', [
    'as' => 'auth.logearse',
    'uses' => 'AuthController@logearse'
]);

Route::get('logout', [
    'as' => 'auth.logout',
    'uses' => 'AuthController@logout'
]);

//------------------ General
Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@home'
]);

Route::get('/registro', [
    'as' => 'registro',
    'uses' => 'UsuariosController@registro'
]);

Route::post('/registro', [
    'as' => 'registro.alta',
    'uses' => 'UsuariosController@alta'
]);

Route::get('/productos', [
    'as' => 'productos',
    'uses' => 'ProductosController@listado'
]);

Route::get('/productos/{id}', [
    'as' => 'producto.ver',
    'uses' => 'ProductosController@ver'
])->where('id', '[0-9]+');

Route::middleware(['auth'])->group(function () {

    Route::get('/carrito', [
        'as' => 'carrito',
        'uses' => 'CarritoController@listado'
    ]);

    Route::delete('/carrito/vaciar/{user}', [
        'as' => 'carrito.vaciar',
        'uses' => 'CarritoController@vaciar'
    ])->where('user', '[0-9]+');

    Route::post('/carrito/item/{id}/{user}', [
        'as' => 'item.agregar',
        'uses' => 'CarritoItemController@agregar'
    ])->where(['id', 'user'], '[0-9]+');

    Route::put('/carrito/item/cantidad/{id}', [
        'as' => 'item.cantidad',
        'uses' => 'CarritoItemController@setCantidadTotal'
    ])->where('id', '[0-9]+');

    Route::delete('/carrito/item/eliminar/{id}', [
        'as' => 'item.eliminar',
        'uses' => 'CarritoItemController@eliminar'
    ])->where('id', '[0-9]+');

    Route::delete('/carrito/item/eliminar/{id}', [
        'as' => 'item.eliminar',
        'uses' => 'CarritoItemController@eliminar'
    ])->where('id', '[0-9]+');

    Route::get('/pedidos/nuevo', [
        'as' => 'pedidos.nuevo',
        'uses' => 'PedidosController@nuevo'
    ])->middleware('verificar.carrito');

    Route::get('/pedidos', [
        'as' => 'pedidos',
        'uses' => 'PedidosController@listado'
    ]);

    Route::post('/pedidos/nuevo/{user}', [
        'as' => 'pedidos.nuevo-alta',
        'uses' => 'PedidosController@alta'
    ])->where('user', '[0-9]+');

    Route::put('/pedidos/anular/{id}', [
        'as' => 'pedidos.anular',
        'uses' => 'PedidosController@anular'
    ])->where('id', '[0-9]+');

    Route::get('/perfil', [
        'as' => 'perfil',
        'uses' => 'UsuariosController@perfil'
    ]);

    Route::get('/perfil/editar', [
        'as' => 'perfil.editar',
        'uses' => 'UsuariosController@editar'
    ]);

    Route::put('/perfil/modificar/{id}', [
        'as' => 'perfil.modificar',
        'uses' => 'UsuariosController@modificar'
    ])->where('id', '[0-9]+');

    Route::delete('/perfil/eliminar/{id}', [
        'as' => 'perfil.eliminar',
        'uses' => 'UsuariosController@eliminar'
    ])->where('id', '[0-9]+');

});

//------------------ Panel
Route::middleware(['verificar.usuario'])->group(function () {

    Route::get('/panel', [
        'as' => 'panel',
        'uses' => 'PanelController@panel'
    ]);


    //---------- Productos
    Route::get('/productos/nuevo', [
        'as' => 'producto.nuevo',
        'uses' => 'ProductosController@nuevo'
    ]);

    Route::post('/productos/nuevo', [
        'as' => 'producto.nuevo-alta',
        'uses' => 'ProductosController@alta'
    ]);

    Route::get('/productos/{id}/editar', [
        'as' => 'producto.editar',
        'uses' => 'ProductosController@editar'
    ]);

    Route::put('/productos/{id}/editar', [
        'as' => 'producto.editar-modificar',
        'uses' => 'ProductosController@modificar'
    ]);

    Route::delete('/productos/{id}', [
        'as' => 'producto.eliminar',
        'uses' => 'ProductosController@eliminar'
    ]);


    //---------- Pedidos
    Route::put('/pedidos/estado/{estado}/{pedido}', [
        'as' => 'pedidos.actualizar',
        'uses' => 'PedidosController@cambiarEstado'
    ])->where(['estado', 'pedido'], '[0-9]+');

    Route::get('/pedidos/{id}', [
        'as' => 'pedidos.ver',
        'uses' => 'PedidosController@ver'
    ])->where('id', '[0-9]+');


    //---------- Usuarios
    Route::get('/usuarios/nuevo', [
        'as' => 'usuario.nuevo',
        'uses' => 'UsuariosController@nuevo'
    ]);

    Route::post('/usuarios/nuevo', [
        'as' => 'usuario.nuevo-alta',
        'uses' => 'UsuariosController@alta'
    ]);

    Route::get('/usuarios/{id}/editar', [
        'as' => 'usuario.editar',
        'uses' => 'UsuariosController@editar'
    ])->where('id', '[0-9]+');

    Route::put('/usuarios/{id}/editar', [
        'as' => 'usuario.editar-modificar',
        'uses' => 'UsuariosController@modificar'
    ])->where('id', '[0-9]+');

    Route::put('/usuarios/tipo/{tipo}/{user}', [
        'as' => 'usuario.actualizar-tipo',
        'uses' => 'UsuariosController@cambiarTipo'
    ])->where(['tipo', 'user'], '[0-9]+');

    Route::delete('/usuarios/{id}', [
        'as' => 'usuarios.eliminar',
        'uses' => 'UsuariosController@eliminar'
    ])->where('id', '[0-9]+');


    //---------- Estadistica
    Route::get('/estadisticas/productos/todos', [
        'as' => 'panel.top-productos-todos',
        'uses' => 'EstadisticasController@topProductos'
    ]);

    Route::get('/estadisticas/productos/{anio}/{mes}', [
        'as' => 'panel.top-productos',
        'uses' => 'EstadisticasController@topProductos'
    ])->where('anio', '[0-9]+');

    Route::get('/estadisticas/pedidos-meses/{anio}', [
        'as' => 'panel.top-pedidos-meses',
        'uses' => 'EstadisticasController@topMeses'
    ])->where('anio', '[0-9]+');

    Route::get('/estadisticas/pedidos-entregados/todos', [
        'as' => 'panel.pedidos-entregados-anulados-todos',
        'uses' => 'EstadisticasController@pedidosEntregadosAnulados'
    ]);

    Route::get('/estadisticas/pedidos-entregados/{anio}/{mes}', [
        'as' => 'panel.pedidos-entregados-anulados',
        'uses' => 'EstadisticasController@pedidosEntregadosAnulados'
    ])->where(['mes', "anio"], '[0-9]+');

    Route::get('/estadisticas/pedidos-zona/todos', [
        'as' => 'panel.pedidos-zona-todos',
        'uses' => 'EstadisticasController@pedidosPorZona'
    ]);

    Route::get('/estadisticas/pedidos-zona/{anio}/{mes}', [
        'as' => 'panel.pedidos-zona',
        'uses' => 'EstadisticasController@pedidosPorZona'
    ])->where(['mes', "anio"], '[0-9]+');


});


