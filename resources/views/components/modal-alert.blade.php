<div class="modal fade modal-table-gear" id="{{ isset($id) ? $id : 'modal-id'  }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-alert" role="document">
        <div class="modal-content {{ isset($bg_gradient) ? $bg_gradient : ''  }}">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">{{ isset($title) ? $title : 'Modal title'  }}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="py-3 text-center">
                    <em class="{{ isset($content_icon) ? $content_icon : 'ni ni-bell-55'  }} ni-3x"></em>
                    <h4 class="heading mt-4">{{ isset($content_title) ? $content_title : 'content'  }}</h4>
                    <p>{{ isset($content) ? $content : 'content'  }}</p>
                </div>

            </div>

            <div class="modal-footer">
                {{ isset($footer) ? $footer : ''  }}
            </div>

            <div class="overlay" style="display: none;">
                <div class="content">
                    <em class="fa fa-3x fa-cog fa-spin"></em>
                </div>
            </div>
        </div>
    </div>
</div>