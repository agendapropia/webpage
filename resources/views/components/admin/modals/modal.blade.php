<!-- Modal -->
<div class="modal fade modal-table-gear" id="{{ $id }}"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background: {{ isset($modalBackground) ? $modalBackground : '#fdfdfd'  }}">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ isset($title) ? $title : 'Modal title'  }}
                    <span class="modal-subtitle"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ isset($block_options) ? $block_options : ''  }}
            </div>
            <div class="modal-body {{ $contentClass ?? '' }}">
                {{ isset($content) ? $content : 'Content'  }}
            </div>
            <div class="modal-footer {{ isset($footerClass) ? $footerClass : ''  }}">
                {{ isset($footer) ? $footer : ''  }}
            </div>
            
            <x-admin.plugins.overlay></x-admin.plugins.overlay>
        </div>
    </div>
</div>
