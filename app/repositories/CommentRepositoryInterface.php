<?php

namespace Framework\Repositories;

interface CommentRepositoryInterface
{

    public function getAllCommentByPost($postId);

    public function createComment($attributes = []);

}