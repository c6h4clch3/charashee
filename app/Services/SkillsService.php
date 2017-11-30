<?php

namespace App\Services;

use App\Models\Coc\Skills\SkillsRepository;

class SkillsService
{
  protected $skill;

  public function __construct(SkillsRepository $skill)
  {
    $this->skill = $skill;
  }

  public function getStandard()
  {
    return array_map(function($skill) {
      return [
        'name'      => $skill->name,
        'init'      => $skill->init,
        'reference' => $skill->reference,
        'is_custom' => $skill->is_custom,
      ];
    }, $this->skill->loadForOptions()->all());
  }
}
