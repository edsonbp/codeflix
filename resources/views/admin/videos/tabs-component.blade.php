<?php
        $tabs = [
            [
                'title' => 'Informações',
                'link' => (!isset($video)) ? route('admin.videos.create') : route('admin.videos.edit', ['video' => $video])
             ],
            [
                'title' => 'Séries e categorias',
                'link' => (!isset($video)) ? '#' : route('admin.videos.relations.create', ['video' => $video]),
                'disabled' => (!isset($video)) ? true : false
             ],
            [
                'title' => 'Video e thumbnail',
                'link' => (!isset($video)) ? '#' : route('admin.videos.uploads.create', ['video' => $video]),
                'disabled' => (!isset($video)) ? true : false

             ],
        ];
?>
<h3>Gerencia vídeos</h3>
<div class="text-right">
    {!! Button::link('listar vídeos')->asLinkTo(route('admin.videos.index')) !!}
</div>
{!! Navigation::tabs($tabs) !!}
<div>
    {!! $slot !!}
</div>