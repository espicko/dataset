<?php

declare(strict_types=1);

namespace Stepapo\Data\UI;

use Nette\Application\UI\Template;
use Nette\Localization\Translator;
use Nextras\Orm\Entity\IEntity;
use Nextras\Orm\Repository\IRepository;
use Stepapo\Data\Column;
use Stepapo\Data\View;
use Nette\Application\UI\Control;
use Nextras\Orm\Collection\ICollection;


abstract class DataControl extends Control
{
	public function render()
	{
		$this->template->columns = $this->getColumns();
		$this->template->views = $this->getViews();
		$this->template->selectedView = $this->getSelectedView();
	}


	protected function createTemplate(): Template
	{
		$template = parent::createTemplate();
		$template->setTranslator($this->getTranslator());
		return $template;
	}


	abstract public function getMainComponent(): ?MainComponent;


	public function getCollection(): ICollection
	{
		return $this->getMainComponent()->getCollection();
	}


	public function getRepository(): IRepository
	{
		return $this->getMainComponent()->getRepository();
	}


	public function getParentEntity(): ?IEntity
	{
		return $this->getMainComponent()->getParentEntity();
	}


	public function getTranslator(): ?Translator
	{
		return $this->getMainComponent()->getTranslator();
	}


	/** @var Column[]|null */
	public function getColumns(): ?array
	{
		return $this->getMainComponent()->getColumns();
	}


	/** @var View[]|null */
	public function getViews(): ?array
	{
		return $this->getMainComponent()->getViews();
	}


	public function getSelectedView(): View
	{
		return $this->getMainComponent()->getSelectedView();
	}
}
