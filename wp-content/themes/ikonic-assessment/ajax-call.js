jQuery(document).ready(function($) {
    $.ajax({
        url: ajax_object.ajax_url,
        type: 'POST',
        data: {
            action: 'get_projects',
        },
        success: function(response) {
            if (response.success) {
                console.log(response.data);
            } else {
                console.error('Failed to retrieve projects');
            }
        },
        error: function(error) {
            console.error(error);
        }
    });
});
