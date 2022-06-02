<!-- Modal -->
<div class="modal fade modal-table-gear" id="{{ $id }}"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background: #fdfdfd">
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
            <div class="modal-body">
                {{ isset($content) ? $content : 'Content'  }}
            </div>
            <div class="modal-footer">
                {{ isset($footer) ? $footer : ''  }}
            </div>
            <div class="overlay overlay-modal" style="display: none;">
                <div class="content">
                    <em class="fa fa-3x fa-cog fa-spin"></em>
                </div>
            </div>
        </div>
    </div>
</div>
