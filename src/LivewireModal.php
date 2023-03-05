<?php

namespace Markrefaat\LivewireModal;

use Livewire\Component;

abstract class LivewireModal extends Component
{
    public $unqiueIdForModal;
    public $modalId;
    public $modalTitle;
    public $modalType;
    public $submitButtonText;
    public $submitButtonFunction;
    public $confirmMessage;
    public $confirmButtonText;
    public $confirmButtonFunction;
    public $onOpenModalFunction;
    public $showCloseIcon = true;
    public $showCloseButton = true;
    private $fields = [];
    private $optionsList = [];
    protected $listeners = [];

    protected function getListeners()
    {
        return [$this->modalId => 'onOpenModal'];
    }
    public function mount()
    {
        $this->unqiueIdForModal = uniqid();
        $this->setUp();
    }
    public function hydrate()
    {
        $this->optionsList = $this->getOptionsListProperty();
        $this->fields = $this->getFieldsProperty();
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function render()
    {
        return view('livewire-modal::modal')
            ->with([
                'fields' => $this->fields,
                'optionsList' => $this->optionsList
            ]);
    }
    abstract public function getOptionsListProperty();
    abstract public function getFieldsProperty();

    // HELPER METHODS
    public function onOpenModal(...$parameters)
    {
        if (count($parameters)) {
            $parameters = $parameters[0];
        }
        // CALL CUSTOM LOGIC
        if (isset($this->onOpenModalFunction))
            $this->{$this->onOpenModalFunction}($parameters);
    }
    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal-' . $this->unqiueIdForModal);
    }
    public function resetModal()
    {
        $this->resetExcept(
            'unqiueIdForModal',
            'modalId',
            'modalTitle',
            'modalType',
            'submitButtonText',
            'submitButtonFunction',
            'confirmMessage',
            'confirmButtonText',
            'confirmButtonFunction',
            'onOpenModalFunction',
            'showCloseIcon',
            'showCloseButton',
            'fields',
            'optionsList',
            'listeners'
        );
        $this->dispatchBrowserEvent('reset-tomSelects-' . $this->unqiueIdForModal);
        $this->resetErrorBag();
    }
    public function resetModalExcept($addExtraExcepts = [])
    {
        $this->resetExcept(
            'unqiueIdForModal',
            'modalId',
            'modalTitle',
            'modalType',
            'submitButtonText',
            'submitButtonFunction',
            'confirmMessage',
            'confirmButtonText',
            'confirmButtonFunction',
            'onOpenModalFunction',
            'showCloseIcon',
            'showCloseButton',
            'fields',
            'optionsList',
            'listeners',
            implode(",", $addExtraExcepts)
        );
        $this->resetErrorBag();
    }

    // SETTERS
    public function setModalType($modalType): self
    {
        $this->modalType = $modalType;
        return $this;
    }
    public function setModalId($modalId): self
    {
        $this->modalId = $modalId;
        return $this;
    }
    public function setModalTitle($modalTitle): self
    {
        $this->modalTitle = $modalTitle;
        return $this;
    }
    public function setOnOpenModalFunction($onOpenModalFunction): self
    {
        $this->onOpenModalFunction = $onOpenModalFunction;
        return $this;
    }
    public function setSubmitButtonText($submitButtonText): self
    {
        $this->submitButtonText = $submitButtonText;
        return $this;
    }
    public function setSubmitButtonFunction($submitButtonFunction): self
    {
        $this->submitButtonFunction = $submitButtonFunction;
        return $this;
    }
    public function setConfirmButtonText($confirmButtonText): self
    {
        $this->confirmButtonText = $confirmButtonText;
        return $this;
    }
    public function setConfirmMessage($confirmMessage): self
    {
        $this->confirmMessage = $confirmMessage;
        return $this;
    }
    public function setConfirmButtonFunction($confirmButtonFunction): self
    {
        $this->confirmButtonFunction = $confirmButtonFunction;
        return $this;
    }
    public function setShowCloseIcon($showCloseIcon): self
    {
        $this->showCloseIcon = $showCloseIcon;
        return $this;
    }
    public function setShowCloseButton($showCloseButton): self
    {
        $this->showCloseButton = $showCloseButton;
        return $this;
    }
}
