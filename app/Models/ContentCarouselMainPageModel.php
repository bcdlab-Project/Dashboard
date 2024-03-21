<?php

namespace App\Models;

use CodeIgniter\Model;

class ContentCarouselMainPageModel extends Model
{
    protected $table = 'ContentCarouselMainPage';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    // protected $returnType = \App\Entities\ContentCarouselMainPage::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['image', 'text_html_en', 'text_html_pt', 'url_link'];

    protected $useTimestamps = false;

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
}