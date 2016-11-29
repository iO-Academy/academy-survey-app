$(function(){
    var button = $('#add-question')
    button.prop("disabled",true)

    $('.question-adder #input-selector').change(function()
    {
        $('#question-options').remove()
        if ($('#input-selector').val() !== 'text-input')
        {
            $('.question-adder').append(
                '<div id="question-options" class="input-group">' +
                '<h4>Options:</h4>' +
                '<input type="text" id="option-text">' +
                '<button class="btn input-group-addon" id="add-option">+</button>' +
                '</div>'
            )

            var $optionInput = $('#option-text')

            $('#add-option').click(function() {
                if($optionInput.val() !== '') {
                    $(this).after(
                        '<div class="input-group">' +
                        '<input class="bg-success" value="' + $optionInput.val() + '" disabled>' +
                        '<button class="btn remove-option input-group-addon">-</button>' +
                        '</div>'
                    )

                    $optionInput.val('')
                    $('.remove-option').click(function(){
                        $(this).parent('div').remove()
                    })
                }
            })
        }
    })

    $('#question').keyup(function(e)
    {
        validateNewQuestion($('#question').val(), button)
    })

    button.click(function(e)
        {
            var question = $('#question').val()
            var type = $('#input-selector').val()

            var required = 'no'
            if($('#required').is(':checked'))
            {
                required = 'yes'
            }

            var options = $('#question-options').children('.input-group').children('input')
            var optionsString = ''

            if(options.length)
            {
                optionsString = '<br>Options: '
                options.each(function(key,option)
                {
                    optionsString += option.value + ', '
                })
                optionsString = optionsString.substr(0,optionsString.length - 2)
            }

            var div =   '<div class="new-question">' +
                            'Question: ' + question +
                            '<br>' +
                            'Type: ' + type +
                            ' Required: ' + required +
                            optionsString +
                        '</div>'

            $('#survey-section').append(div)

        }
    )
})

/**
 * Validates input of new question form
 * Enables button if all inputs valid
 *
 * @param STRING question text in question's text box
 * @param JQUERYSELECTOR button to be enabled
 */
 function validateNewQuestion (question, button)
 {
    if(question.length >= 10 && question.length <= 255)
    {
        button.prop("disabled",false)
    }
    else
    {
        button.prop("disabled",true)
    }

    //TODO Add validation for radio options
    //TODO Add validation for checkbox options
}