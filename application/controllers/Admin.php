<?php

class Admin extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();

        $this->load->library("parser");
        $this->load->library("form_validation");

        $this->load->helper("url");
        $this->load->helper("form");
        $this->load->helper("text");

        $this->load->helper("Date_helper");
        $this->load->helper("Post_helper");

        $this->load->model('Post');
    }

    public function index(){
        $this->load->view('admin/test');
    }

    public function post_list(){
        //el orden del método parse() tiene que ir al final, sino la vista no recibe el nombre
        $data["posts"] = $this->Post->findAll();
        $view["body"] = $this->load->view('admin/post/list', $data, TRUE);
        $view["title"] = 'Posts';
        $this->parser->parse("admin/template/body", $view);
    }

    public function post_delete($post_id = null){
        if($post_id == null){ 
            echo 0;
        } else {
            // $this->Post->delete($post_id);
            echo 1;
        }
    }

    public function post_save(){
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $this->form_validation->set_rules('title', 'Título', 'required|min_length[10]|max_length[65]');
            $this->form_validation->set_rules('content', 'Contenido', 'required|min_length[10]');
            $this->form_validation->set_rules('description', 'Descripción', 'min_length[100]');
            $this->form_validation->set_rules('posted', 'Publicación', 'required');

            if($this->form_validation->run()){
                //nuestro form es valido
                $url_clean = $this->input->post("url_clean");

                if($url_clean == ""){
                    $url_clean = clean_name($this->input->post("title"));
                }

                $save = array(
                    'title' => $this->input->post("title"),
                    'content' => $this->input->post("content"),
                    'description' => $this->input->post("description"),
                    'posted' => $this->input->post("posted"),
                    'url_clean' => $url_clean
                );

                $post_id = $this->Post->insert($save);

                $this->upload($post_id, $this->input->post("title"));
            }
        }

        //el orden del método parse() tiene que ir al final, sino la vista no recibe el nombre
        $data["data_posted"] = posted();
        $view["body"] = $this->load->view('admin/post/save', $data, TRUE);
        $view["title"] = 'Crear Post';

        $this->parser->parse("admin/template/body", $view);
    }

    private function upload($post_id, $title){
        $image = "image";

        $title = clean_name($title);

        $config["upload_path"] = 'uploads/post'; //carpetas locales
        $config["file_name"] = $title;
        $config["allowed_types"] = 'gif|png|jpg';
        $config["max_size"] = 5000;
        $config["overwrite"] = TRUE;

        //cargamos la librería
        $this->load->library('upload', $config);

        if($this->upload->do_upload($image)){
            //se cargó la imagen

            //datos del upload
            $data = $this->upload->data();
            $save = array(
                'image' => $title. $data["file_ext"]
            );
            $this->Post->update($post_id, $save);
            $this->resize_image($data["full_path"]);
        }
    }

    
    function resize_image($path_image){
        $config["image_library"] = 'gd2';
        $config["source_image"] = $path_image;
        // $config["create_thumb"] = TRUE;
        $config["maintain_ratio"] = TRUE;
        $config["width"] = 500;
        $config["height"] = 500;

        $this->load->library("image_lib", $config);
        $this->image_lib->resize();
    }
}