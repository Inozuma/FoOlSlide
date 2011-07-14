<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reader extends REST_Controller {

    function comic_get() {
        if (!$this->get('id')) {
            $this->response(NULL, 400);
        }

        $comic = new Comic();
        $comic->where('id', $this->get('id'))->limit(1)->get();

        if ($comic->result_count() == 1) {
            $chapters = new Chapter();
            $chapters->where('comic_id', $comic->id)->get();
            $result = $comic->to_array();
            $result["chapters"] = $chapters->to_array();
            $this->response($result, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => _('Comic could not be found')), 404);
        }
    }

    function chapter_get() {
        if (!$this->get('id')) {
            $this->response(NULL, 400);
        }

        $chapter = new Chapter();
        $chapter->where('id', $this->get('id'))->limit(1)->get();

        if ($chapter->result_count() == 1) {
            $chapter->get_comic();
            
            $result = $chapter->to_array();
            $result['comic'] = $chapter->comic->to_array();
            $result['pages'] = $chapter->get_pages();


            $this->response($result, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => _('Comic could not be found')), 404);
        }
    }

}