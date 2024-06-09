<?php
use Controller\PostController;
use Controller\AuthController;

$r->addRoute('GET', '/posts', [PostController::class, 'getPosts']);
$r->addRoute('POST', '/post', [PostController::class, 'createPost']);
$r->addRoute('PUT', '/post', [PostController::class, 'updatePost']);
$r->addRoute('DELETE', '/post', [PostController::class, 'deletePost']);
$r->addRoute('POST', '/login', [AuthController::class, 'login']);
$r->addRoute('POST', '/signup', [AuthController::class, 'signup']);
