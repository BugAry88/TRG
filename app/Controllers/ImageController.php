<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ImageController extends Controller
{
    public function serve($type, $filename)
    {
        $allowedTypes = ['plinths', 'tonearms', 'cartridges', 'power', 'products', 'uploads'];

        if (!in_array($type, $allowedTypes)) {
            return $this->response->setStatusCode(404);
        }

        $filePath = FCPATH . 'images/' . $type . '/' . $filename;

        if (!file_exists($filePath)) {
            return $this->response->setStatusCode(404);
        }

        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $mimeTypes = [
            'svg'  => 'image/svg+xml',
            'png'  => 'image/png',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif'  => 'image/gif',
            'webp' => 'image/webp',
        ];

        $mime = $mimeTypes[$ext] ?? 'application/octet-stream';

        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setHeader('Cache-Control', 'public, max-age=86400')
            ->setBody(file_get_contents($filePath));
    }
}
