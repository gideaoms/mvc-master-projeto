<?php

namespace Helpers;

class UploadHelper {

    private $file;
    private $extensoes_permitidas;
    private $error_message;
    private $name;
    private $path = "public/upload/";

    public function __construct($input) {
        $this->extensoes_permitidas = array('png', 'jpg');
        $this->file = (isset($_FILES[$input]) ? $_FILES[$input] : null);
    }

    public function save($folder) {
        $this->path .= $folder;

        if (!file_exists($this->path)) {
            /** usa-se o numero e true para permissao de pasta */
            mkdir($this->path, 0775, true);
        }

        /** Verifica se foi enviado mais de um arquivo */
        if (is_array($this->file['name'])) {
            $count = count($this->file['name']);

            $fotos = array();
            for ($i = 0; $i < $count; $i++) {

                $ext = pathinfo($this->file['name'][$i], PATHINFO_EXTENSION);

                $oldname = $this->file['tmp_name'][$i];
                $newname = date('YmdHis') . $i . '.' . $ext;
                $this->name = $newname;

                if(move_uploaded_file($oldname, $this->path . '/' . $newname)) {
                    $fotos[] = $newname;
                }
            }
            return $fotos;
        } else {
            $ext = pathinfo($this->file['name'], PATHINFO_EXTENSION);

            if (!in_array($ext, $this->extensoes_permitidas)) {
                $this->error_message = array('message' => 'A extensão do arquivo não é permitida! - ' . $ext , 'redirect' => 'no-redirect');
                echo json_encode($this->error_message);
                return false;
            }

            if (!$this->validarDimensoes($ext)) {
                return false;
            }

            $oldname = $this->file['tmp_name'];
            $newname = date('YmdHis') . '.' . $ext;

            if(move_uploaded_file($oldname, $this->path . '/' . $newname)){
                $this->name = $newname;
                return true;
            } else {
                $this->error_message = array('message' => 'Erro, não foi possível fazer upload da imagem, tente novamente!', 'redirect' => 'no-redirect');
                echo json_encode($this->error_message);
                return false;
            }
        }
    }

    public function getName() {
        return $this->name;
    }

    private function validarDimensoes($ext) {
        $img = null;
        switch ($ext) {
            case 'png': {
                $img = imagecreatefrompng($this->file['tmp_name']);
                break;
            }
            case 'jpg': {
                $img = imagecreatefromjpeg($this->file['tmp_name']);
                break;
            }
        }
        $width = imagesx($img);
        $height = imagesy($img);
        if ($width < 600) {
            $this->error_message = array('message' => 'A largura mínima permitida é de 600px', 'redirect' => 'no-redirect');
            echo json_encode($this->error_message);
            return false;
        } else if ($height < 300) {
            $this->error_message = array('message' => 'A altura mínima permitida é de 300px', 'redirect' => 'no-redirect');
            echo json_encode($this->error_message);
            return false;
        }
        return true;
    }

}