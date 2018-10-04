<?php

namespace App\Http\Controllers;
use App\Mproducto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $productos = Mproducto::join('categoria','producto.idcategoria','=','categoria.id')
            ->select('producto.id','producto.idcategoria','producto.codigo','producto.thumbnail','producto.medium','producto.large','producto.image','producto.nombre','categoria.nombre as nombre_categoria','producto.precio','producto.stockminimo','producto.stockmaximo','producto.stockactual','producto.descripcion','producto.condicion')
            ->orderBy('producto.id', 'desc')->paginate(10);
        }
        else{
            $productos = Mproducto::join('categoria','producto.idcategoria','=','categoria.id')
            ->select('producto.id','producto.idcategoria','producto.codigo','producto.thumbnail','producto.medium','producto.large','producto.image','producto.nombre','categoria.nombre as nombre_categoria','producto.precio','producto.stockminimo','producto.stockmaximo','producto.stockactual','producto.descripcion','producto.condicion')
            ->where('producto.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('producto.id', 'desc')->paginate(10);
        }
        

        return [
            'pagination' => [
                'total'        => $productos->total(),
                'current_page' => $productos->currentPage(),
                'per_page'     => $productos->perPage(),
                'last_page'    => $productos->lastPage(),
                'from'         => $productos->firstItem(),
                'to'           => $productos->lastItem(),
            ],
            'productos' => $productos
        ];
    }

    public function listarProducto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $productos = Mproducto::join('categoria','producto.idcategoria','=','categoria.id')
            ->select('producto.id','producto.idcategoria','producto.codigo','producto.nombre','categoria.nombre as nombre_categoria','producto.precio','producto.stockminimo','producto.stockmaximo','producto.stockactual','producto.descripcion','producto.condicion')
            ->orderBy('producto.id', 'desc')->paginate(10);
        }
        else{
            $productos = Mproducto::join('categoria','producto.idcategoria','=','categoria.id')
            ->select('producto.id','producto.idcategoria','producto.codigo','producto.nombre','categoria.nombre as nombre_categoria','producto.precio','producto.stockminimo','producto.stockmaximo','producto.stockactual','producto.descripcion','producto.condicion')
            ->where('producto.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('producto.id', 'desc')->paginate(10);
        }
        

        return ['productos' => $productos];
    }

    public function listarPdf(Request $request)
    {
        $productos = Mproducto::join('categoria','producto.idcategoria','=','categoria.id')
        ->select('producto.id','producto.idcategoria','producto.codigo','producto.nombre','categoria.nombre as nombre_categoria','producto.precio','producto.stockminimo','producto.stockmaximo','producto.stockactual','producto.descripcion','producto.condicion')
        ->orderBy('producto.nombre','desc')
        ->get();

        $cont = Mproducto::count();

        $pdf = \PDF::loadView('pdf.productopdf',['productos'=>$productos,'cont'=>$cont]);
        return $pdf->download('producto.pdf');
    }
 
    public function listarProductoVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $productos = Mproducto::join('categoria','producto.idcategoria','=','categoria.id')
            ->select('producto.id','producto.idcategoria','producto.codigo','producto.nombre','categoria.nombre as nombre_categoria','producto.precio','producto.stockminimo','producto.stockmaximo','producto.stockactual','producto.descripcion','producto.condicion')
            ->where('producto.stockactual','>','0')
            ->orderBy('producto.id', 'desc')->paginate(10);
        }
        else{
            $productos = Mproducto::join('categoria','producto.idcategoria','=','categoria.id')
            ->select('producto.id','producto.idcategoria','producto.codigo','producto.nombre','categoria.nombre as nombre_categoria','producto.precio','producto.stockminimo','producto.stockmaximo','producto.stockactual','producto.descripcion','producto.condicion')
            ->where('producto.'.$criterio, 'like', '%'. $buscar . '%')
            ->where('producto.stockactual','>','0')
            ->orderBy('producto.id', 'desc')->paginate(10);
        }
        

        return ['productos' => $productos];
    }

    public function buscarProducto(Request $request){
        if (!$request->ajax()) return redirect('/');

        $filtro = $request->filtro;
        $producto = Mproducto::where('codigo','=', $filtro)
        ->select('id','nombre')->orderBy('nombre', 'asc')->take(1)->get();

        return ['producto' => $producto];
    }

    public function buscarProductoVenta(Request $request){
        if (!$request->ajax()) return redirect('/');

        $filtro = $request->filtro;
        $producto = Mproducto::where('codigo','=', $filtro)
        ->select('id','nombre','stockactual','precio')
        ->where('stockactual','>','0')
        ->orderBy('nombre', 'asc')
        ->take(1)->get();

        return ['producto' => $producto];
    }
    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = new Mproducto();
        $producto->idcategoria = $request->idcategoria;
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stockactual = $request->stockactual;
        $producto->stockminimo = $request->stockminimo;
        $producto->stockmaximo = $request->stockmaximo;
        $producto->descripcion = $request->descripcion;
        $producto->image = $request->full;
        $producto->thumbnail = $request->thumbnail;
        $producto->medium = $request->medium;
        $producto->large = $request->large;
        $producto->condicion = '1';
        $producto->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = Mproducto::findOrFail($request->id);
        $producto->idcategoria = $request->idcategoria;
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stockactual = $request->stockactual;
        $producto->stockminimo = $request->stockminimo;
        $producto->stockmaximo = $request->stockmaximo;
        $producto->descripcion = $request->descripcion;
        $producto->image = $request->full;
        $producto->thumbnail = $request->thumbnail;
        $producto->medium = $request->medium;
        $producto->large = $request->large;
        $producto->condicion = '1';
        $producto->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = Mproducto::findOrFail($request->id);
        $producto->condicion = '0';
        $producto->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = Mproducto::findOrFail($request->id);
        $producto->condicion = '1';
        $producto->save();
    }
}
