<div>
    <script>
        var tomSelects = [];
    </script>
    <div wire:ignore.self class="modal fade" id="{{$modalId}}" tabindex="-1" aria-labelledby="{{$modalId}}Label"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{$modalId}}Label">{{$modalTitle}}
                    </h5>
                    @if($showCloseIcon)
                    <button type="button" class="btn-close btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal"></button>
                    @endif
                </div>
                @if($modalType == "formModal")
                <form wire:submit.prevent="{{$submitButtonFunction}}">
                    <div class="modal-body">
                        <div class="row">
                            @foreach ($fields as $field)
                            <div class="{{$field->getClass() ?? 'col-12'}} mb-3">
                                @if ($field->getLabel() != null)
                                <label>
                                    {{$field->getLabel()}}
                                    @if ($field->getRequired())
                                    <span style="color: red">*</span>
                                    @endif
                                </label>
                                @endif
                                @if($field->getType() == 'dropdown')
                                @if($field->getOptionMulti() > 1)
                                <div wire:ignore>
                                    <select {{ $field->getDisabled() == true ? 'disabled' : '' }}
                                        id="{{$field->getVarName()}}{{$unqiueIdForModal}}"
                                        {{ $field->getDefer() == true ? 'wire:model.defer='.$field->getVarName() :
                                        'wire:model='.$field->getVarName() }} class="form-control form-control-sm">
                                        <option value=""></option>
                                        @foreach ($optionsList[$field->getOptions()] as $option)
                                        <option value="{{$option[$field->getOptionValue()]}}">
                                            {{$option[$field->getOptionName()]}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <script>
                                    tomSelects.push(new TomSelect("#{{$field->getVarName()}}{{$unqiueIdForModal}}",{
                                        create: false,
                                        maxItems: @js($field->getOptionMulti()),
                                        items: @js(${$field->getVarName()})
                                    }));
                                </script>
                                @else
                                <div wire:ignore>
                                    <select wire:ignore {{ $field->getDisabled() == true ? 'disabled' : '' }}
                                        id="{{$field->getVarName()}}{{$unqiueIdForModal}}"
                                        {{ $field->getDefer() == true ? 'wire:model.defer='.$field->getVarName() :
                                        'wire:model='.$field->getVarName() }} class="form-control form-control-sm">
                                        <option value=""></option>
                                        @foreach ($optionsList[$field->getOptions()] as $option)
                                        <option value="{{$option[$field->getOptionValue()]}}">
                                            {{$option[$field->getOptionName()]}}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        tomSelects.push(new TomSelect("#{{$field->getVarName()}}{{$unqiueIdForModal}}",{
                                            create: false,
                                            items: [@js(${$field->getVarName()})]
                                        }));
                                    </script>
                                </div>
                                @endif


                                @elseif($field->getType() == 'textarea')
                                <textarea {{
                                    $field->getDisabled() == true ? 'disabled' : '' }}
                                    @if( $field->getPlaceholder() != null) 
                                        placeholder="{{$field->getPlaceholder()}}{{ ($field->getRequired() == true) ? '*' : ''}}" 
                                    @endif 
                                cols="30" rows="10" wire:model="{{$field->getVarName()}}" class="form-control"></textarea>


                                @else
                                <input {{ $field->getDisabled() == true ? 'disabled' : '' }}
                                @if( $field->getPlaceholder() != null) placeholder="{{$field->getPlaceholder()}}
                                {{( $field->getRequired() == true) ? '*' : ''}}" @endif
                                wire:model="{{$field->getVarName()}}" class="form-control" type="{{$field->getType()}}">
                                @endif

                                @error($field->getVarName()) <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            @if ($showCloseButton)
                            <button type="button" class="btn btn-secondary" wire:click="closeModal"
                                data-bs-dismiss="modal">Close</button>
                            @endif
                            <button type="submit" class="btn btn-primary">{{$submitButtonText}}</button>
                        </div>
                    </div>
                </form>
                @elseif($modalType == "confirmationModal")
                <form wire:submit.prevent="{{$confirmButtonFunction}}">
                    <div class="modal-body">
                        <h5>{{$confirmMessage}}</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">{{$confirmButtonText}}</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('close-modal-{{$unqiueIdForModal}}', event => {
            $('#{{$modalId}}').modal('hide');
        })
        window.addEventListener('reset-tomSelects-{{$unqiueIdForModal}}', event => {
            tomSelects.forEach(tomSelect => {
                tomSelect.clear(true);
            });
        });
    </script>
</div>
