@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="row">
            <h3>Listagem de Categorias</h3>
            {!! Button::primary('Nova Categoria')->asLinkTo(route('admin.categories.create')) !!}
        </div>

        <div class="row">
            {!!
                 Table::withContents($categories->items())->striped()
                 ->callback('Ações', function($field, $category){
                     $linkEdit = route('admin.categories.edit',['category' => $category->id]);
                     $linkShow = route('admin.categories.show',['category' => $category->id]);
                     return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit)->addAttributes(['id' => "edit_{$category->id}"]).'|'.
                     Button::link(Icon::create('remove'))->asLinkTo($linkShow)->addAttributes(['id' => "delete_{$category->id}"]);
                 })
            !!}
        </div>

        {!! $categories->links() !!}
    </div>
@endsection