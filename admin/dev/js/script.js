var primal = {
    reactionTime: 10000,
    reactionTimeout: ''
};


/* Methods */
function show(node) {
    node.style.display = '';
};

function hide(node) {
    node.style.display = 'none';
};

function showReaction(reaction) {
    if (reaction.status === 'error') {
        reaction.status = 'fail';
    }
    primal.reactionBox.setAttribute('class', reaction.status);
    primal.reactionBox.innerHTML = reaction.text;
    
    window.clearTimeout(primal.reactionTimeout);
    primal.reactionTimeout = window.setTimeout( hideReaction , primal.reactionTime);
}

function hideReaction() {
    primal.reactionBox.setAttribute('class', '');
}

function serializeForm(form) {
    var result = [];
    if (typeof form === 'object' && form.nodeName.toLowerCase() === 'form') {
        Array.prototype.slice.call(form.elements).forEach(function (control) {
            if (control.name && !control.disabled && ['file', 'reset', 'submit', 'button'].indexOf(control.type) === -1)
                if (control.type === 'select-multiple') {
                    Array.prototype.slice.call(control.options).forEach(function (option) {
                        if (option.selected) result.push(encodeURIComponent(control.name) + '=' + encodeURIComponent(option.value));
                    });
                } else if (['checkbox', 'radio'].indexOf(control.type) === -1 || control.checked) {
                result.push(encodeURIComponent(control.name) + '=' + encodeURIComponent(control.value))
            };
        });
    }
    return result.join('&').replace(/%20/g, '+') + '&ajax=true';
};

function sendForm(e) {
    e.preventDefault();
    var form = e.target;
    var dataToSend = serializeForm(form);
    var request = new XMLHttpRequest();
    var urlrequest = form.getAttribute('action');
    request.open('POST', urlrequest, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(dataToSend);
    request.onload = function () {
        if (this.status >= 200 && this.status < 400) {
            try {
                var ajaxReaction = JSON.parse(this.responseText);
                showReaction(ajaxReaction);
            } catch (e) {
                showReaction({
                    status: 'fail',
                    text: 'Błąd w odpowiedzi.'
                });
            }
        } else {
            showReaction({
                status: 'fail',
                text: 'Błąd w odpowiedzi.'
            });
        }
    };
    request.onerror = function () {
        showReaction({
            status: 'fail',
            text: 'Błąd w przesyłania danych.'
        });
    };
}


document.addEventListener('DOMContentLoaded', function () {
    primal.reactionBox = document.getElementById('primal-reaction');
    
    tinymce.init({
        selector: '.wysiwyg.regular',
        inline: true,
        placeholder: "Twoja treść",
        plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste'
      ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
    });


    /* Primal forms ajax */
    if (document.querySelector('.primal-form') !== null) {
        var primalForms = document.querySelectorAll('.primal-form');

        Array.prototype.forEach.call(primalForms, function (el, i) {
            el.addEventListener('submit', sendForm);
        });
    }
    
    /* Reaction */
    primal.reactionBox.addEventListener( 'click', hideReaction );
});
