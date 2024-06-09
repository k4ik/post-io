<?php
use Controller\PostController;

$r->addRoute('GET', '/posts', [PostController::class, 'getPosts']);
$r->addRoute('POST', '/post', [PostController::class, 'createPost']);
$r->addRoute('PUT', '/post', [PostController::class, 'updatePost']);
$r->addRoute('DELETE', '/post', [PostController::class, 'deletePost']);
