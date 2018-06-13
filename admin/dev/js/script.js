var primal = {
    reactionTime: 3000,
    reloadTime: 1300,
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
    primal.reactionTimeout = window.setTimeout(hideReaction, primal.reactionTime);

    if (reaction.reload == true) {

        if (reaction.newurl) {
            location.pathname = reaction.newurl;
        } else {
            window.setTimeout(function (e) {
                location.reload()
            }, primal.reloadTime);
        }
    }
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
    if (e.target.id === 'primal-edit-page-form') {
        var extraFieldsHTML = '';
        if (document.querySelector('[data-block-update="true"][data-block-key]') !== null) {
            var blocksToUpdate = document.querySelectorAll('[data-block-update="true"][data-block-key]');

            var blocksKeysInputValue = [];
            var blocksInputs = '';
            Array.prototype.forEach.call(blocksToUpdate, function (el, i) {
                var blockKey = el.getAttribute('data-block-key');
                var blockHTML = tinymce.get('cms-field-' + blockKey).getContent();
                blockHTML = blockHTML.replace(/&lt;/g, '|&lt;|');
                blockHTML = blockHTML.replace(/&gt;/g, '|&gt;|');
                blocksKeysInputValue.push(blockKey);

                blocksInputs += '<textarea class="hidden" name="' + blockKey + '">' + blockHTML + '</textarea>';
            });
            extraFieldsHTML += '<input type="hidden" name="blockkeys" value="' + blocksKeysInputValue.join(',') + '">' + blocksInputs;
        }
        if (document.querySelector('[data-block-update="true"][data-siteblock-key]') !== null) {
            var blocksToUpdate = document.querySelectorAll('[data-block-update="true"][data-siteblock-key]');

            var blocksKeysInputValue = [];
            var blocksInputs = '';
            Array.prototype.forEach.call(blocksToUpdate, function (el, i) {
                var blockKey = el.getAttribute('data-siteblock-key');
                var blockHTML = el.innerHTML;
                blockHTML = blockHTML.replace(/data-mce-style="(.*?)"/ig, ''); // hack   
                blockHTML = blockHTML.replace(/data-mce-bogus="(.*?)"/ig, ''); // hack   

                blocksKeysInputValue.push(blockKey);

                blocksInputs += '<textarea class="hidden" name="' + blockKey + '">' + blockHTML + '</textarea>';
            });
            e.target.querySelector('.primal-hidden-fields').innerHTML = '<input type="hidden" name="blockkeys" value="' + blocksKeysInputValue.join(',') + '">' + blocksInputs;

            extraFieldsHTML += '<input type="hidden" name="siteblockkeys" value="' + blocksKeysInputValue.join(',') + '">' + blocksInputs;
        }
        e.target.querySelector('.primal-hidden-fields').innerHTML = extraFieldsHTML;
    } else if (e.target.id === 'primal-edit-portal-form') {
        var extraFieldsHTML = '';
        console.log('test');
        if (document.querySelector('.primal-menu-input ul') !== null) {
            var menusToUpdate = document.querySelectorAll('.primal-menu-input ul');

            var menuObjects = {};
            var blocksInputs = '';
            Array.prototype.forEach.call(menusToUpdate, function (menuEl, i) {
                
                if (menuEl.querySelector('li') !== null) {
                    var menuObject = [];
                    var itemsToUpdate = menuEl.querySelectorAll('li');
                    Array.prototype.forEach.call(itemsToUpdate, function (menuItemEl, i) {
                        var itemType = menuItemEl.getAttribute('data-type');
                        var itemRel = menuItemEl.getAttribute('data-rel') == 'true' ? true : false;
                        var itemTarget = menuItemEl.getAttribute('data-target') == 'true' ? true : false;
                        
                        console.log(itemType+' '+itemRel+' '+itemTarget);
                        
                        var itemObject = {};
                        
                        if ( itemRel ) { itemObject.rel = 'nofollow'; }
                                
                        if ( itemTarget ) { itemObject.target = '_blank'; }
                        
                        switch(itemType) {
                            case "cms":
                                var itemKey = menuItemEl.getAttribute('data-key');
                                
                                itemObject.type = 'cms';
                                itemObject.key = itemKey;
                                
                                menuObject.push( itemObject );
                                break;
                                
                            case "url":
                                var itemName = menuItemEl.getAttribute('data-name');
                                var itemUrl = menuItemEl.getAttribute('data-url');
                                
                                itemObject.type = 'url';
                                itemObject.name = itemName;
                                itemObject.url = itemUrl;
                                
                                menuObject.push( itemObject );
                                break;
                        }
                        
                        
                        
                    });
                    var menuName = menuEl.getAttribute('data-name');
                    menuObjects[menuName] = menuObject;
                }
            });
            
            var jsonToInput = JSON.stringify(menuObjects).replace(/"/g, '&qout;');
            e.target.querySelector('.primal-hidden-fields').innerHTML = '<input type="hidden" name="menukeys" value="' + jsonToInput + '">';
        }
    }

    var form = e.target;
    var dataToSend = serializeForm(form);
    console.log(dataToSend);
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
                    text: 'Błąd w odpowiedzi. <i class="primal-icon-rain"></i>'
                });
            }
        } else {
            showReaction({
                status: 'fail',
                text: 'Błąd w odpowiedzi. <i class="primal-icon-rain"></i>'
            });
        }
    };
    request.onerror = function () {
        showReaction({
            status: 'fail',
            text: 'Błąd w przesyłania danych. <i class="primal-icon-download"></i>'
        });
    };
}

function sendLink(e) {
    e.preventDefault();
    var urlrequest = e.target.getAttribute('href');
    var request = new XMLHttpRequest();
    request.open('POST', urlrequest, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send();
    request.onload = function () {
        if (this.status >= 200 && this.status < 400) {
            try {
                var ajaxReaction = JSON.parse(this.responseText);
                showReaction(ajaxReaction);
            } catch (e) {
                showReaction({
                    status: 'fail',
                    text: 'Błąd w odpowiedzi. <i class="primal-icon-rain"></i>'
                });
            }
        } else {
            showReaction({
                status: 'fail',
                text: 'Błąd w odpowiedzi. <i class="primal-icon-rain"></i>'
            });
        }
    };
    request.onerror = function () {
        showReaction({
            status: 'fail',
            text: 'Błąd w przesyłania danych. <i class="primal-icon-download"></i>'
        });
    };
}

function primalBlockToUpdate(e) {
    /* SendForm() will add blocks inputs on submit */
    var node = e.target.targetElm;
    node.setAttribute('data-block-update', 'true');
}

function primalCheckThis(node) {
    var text = node.value;
    if (text === '') {
        node.setAttribute('class', '');
        //        checkInfo(node);
    } else if (node.getAttribute('data-check-length') !== '' && text.length < node.getAttribute('data-check-length')) {
        node.setAttribute('class', 'not-empty error');
        //        checkInfo(node, 'potrzebujesz jeszcze ' + (node.getAttribute('data-val-length')-text.length) + ' znaków');
        console.log('potrzebujesz jeszcze ' + (node.getAttribute('data-check-length') - text.length) + ' znaków');
    } else if (node.getAttribute('data-val-email') === 'true' && !(/^(([^<>()\[\]!\.,;:\s@"]+(\.[^<>()\[\]\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(text))) {
        node.setAttribute('class', 'not-empty error');
        node.value = text.toLowerCase();
        //        checkInfo(node, 'mail nie wydaje siÄ poprawny');
    } else if (text !== '') {
        node.setAttribute('class', 'not-empty valid');
        //        checkInfo(node, '<span class="icon-check"></span>');
    }
}

function appendMenuItem( type ) {
    if ( type == "cms" ) {
        var itemName = document.getElementById('itemcmspage').options[document.getElementById('itemcmspage').selectedIndex].text;
        var itemKey = document.getElementById('itemcmspage').value;
        var itemMenu = document.getElementById('itemmenucms').value;
        var itemIcon = 'd-title primal-icon-book';
        var itemIconTitle = 'Podstrona CMS';
    } else if ( type == "url" ) {
        var itemName = document.getElementById('itemname').value;
        var itemURL = document.getElementById('itemurl').value;
        var itemMenu = document.getElementById('itemmenuurl').value;
        var itemIcon = 'd-title primal-icon-browser';
        var itemIconTitle = 'Strona WWW';
    }
    
    if (itemName == '' || itemURL == '') {
        showReaction({
            status: 'fail',
            text: 'Nazaw i adres są wymagane. <i class="primal-icon-write"></i>'
        });
    } else {
        var menu = document.querySelector('.primal-menu-input[data-menu="'+itemMenu+'"] ul'); 
        console.log( menu ); 
        // jQuery().append();
        var menuElLi = document.createElement('li');
            menuElLi.setAttribute('draggable', true); 
            menuElLi.setAttribute('ondragenter', 'dragenter(event)'); 
            menuElLi.setAttribute('ondragstart', 'dragstart(event)');
            menuElLi.setAttribute('data-target', 'false');
            menuElLi.setAttribute('data-rel', 'false');
            menuElLi.setAttribute('data-type', type);
            if ( itemKey ) {
                menuElLi.setAttribute('data-key', itemKey);
            }
            if ( itemURL ) {
                menuElLi.setAttribute('data-url', itemURL);   
            }
            menuElLi.setAttribute('data-name', itemName.replace('"', '&quot;'));
        var menuElLiTypeIcon = document.createElement('i');
            menuElLiTypeIcon.setAttribute('class', itemIcon); 
            menuElLiTypeIcon.setAttribute('data-title', itemIconTitle); 
            menuElLi.appendChild(menuElLiTypeIcon);        
        var menuElText = document.createTextNode(' '+itemName);
            menuElLi.appendChild(menuElText);
        var menuElAdmin = document.createElement('span');
            menuElAdmin.setAttribute('class', 'cms-menu-admin'); 
        var menuElLiAdmin1 = document.createElement('i');
            menuElLiAdmin1.setAttribute('class', 'primal-icon-calendar d-title'); 
            menuElLiAdmin1.setAttribute('data-title', 'Indeksuj w wyszukiwarkach');
            menuElAdmin.appendChild(menuElLiAdmin1);
        var menuElText1 = document.createTextNode(' ');
            menuElAdmin.appendChild(menuElText1);
        var menuElLiAdmin2 = document.createElement('i');
            menuElLiAdmin2.setAttribute('class', 'primal-icon-windows d-title'); 
            menuElLiAdmin2.setAttribute('data-title', 'Otwieraj w nowym oknie'); 
            menuElAdmin.appendChild(menuElLiAdmin2);
        var menuElText2 = document.createTextNode(' ');
            menuElAdmin.appendChild(menuElText2);
        var menuElLiAdmin3 = document.createElement('i');
            menuElLiAdmin3.setAttribute('class', 'primal-icon-trash d-title'); 
            menuElLiAdmin3.setAttribute('data-title', 'Usuń z menu'); 
            menuElAdmin.appendChild(menuElLiAdmin3);
            menuElLi.appendChild(menuElAdmin);

        menu.appendChild(menuElLi);

        showReaction({
            status: 'success',
            text: 'Dodano adres "'+itemName+'" <i class="primal-icon-plus"></i>'
        });
        
        if ( type == "cms" ) {
            document.getElementById('addcmspage').checked = false;
        } else if ( type == "url" ) {
            document.getElementById('itemname').value = '';
            document.getElementById('itemurl').value = ''; 
            document.getElementById('addlink').checked = false;
        }
    }
    
}

function isBefore(a, b) {
    if (a.parentNode == b.parentNode) {
        for (var cur = a; cur; cur = cur.previousSibling) {
            if (cur === b) {
                return true;
            }
        }
    }
    return false;
}

function dragenter(e) {
    if (isBefore(primal.soruce, e.target)) {
        e.target.parentNode.insertBefore(primal.soruce, e.target);
    } else {
        e.target.parentNode.insertBefore(primal.soruce, e.target.nextSibling);
    }
}

function dragstart(e) {
    primal.soruce = e.target;
    e.dataTransfer.setData('text/plain', '');
    e.dataTransfer.effectAllowed = 'move';

    return;
}

document.addEventListener('DOMContentLoaded', function () {
    primal.reactionBox = document.getElementById('primal-reaction');
    primal.editPageForm = document.querySelector('#primal-cms-edit-page form');

    tinymce.init({
        selector: '.wysiwyg.regular',
        inline: true,
        placeholder: "Twoja treść",
        plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste'
      ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code',
        init_instance_callback: function (editor) {
            editor.on('change', primalBlockToUpdate);
        }
    });

    /* Prevent submit by enter in subtabs */
    if (document.querySelector('.more-when-checked input') !== null) {
        var primalSubtabsInputs = document.querySelectorAll('.more-when-checked input');
        Array.prototype.forEach.call(primalSubtabsInputs, function (el, i) {
            el.addEventListener('keypress', function (e) {
                if (e.key == 'Enter' || e.keyCode == 13) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });
        });
    }

    /* Primal forms ajax */
    if (document.querySelector('.primal-form') !== null) {
        var primalForms = document.querySelectorAll('.primal-form');

        Array.prototype.forEach.call(primalForms, function (el, i) {
            el.addEventListener('submit', sendForm);
        });
    }

    if (document.querySelector('.primal-ajax-link') !== null) {
        var primalLinks = document.querySelectorAll('.primal-ajax-link');

        Array.prototype.forEach.call(primalLinks, function (el, i) {
            el.addEventListener('click', sendLink);
        });
    }

    /* Add nocmslink to firts menu */
    document.getElementById('primal-addlink').addEventListener('click', function (e) {
        appendMenuItem("url");
    }); 
    
    /* Add cmslink to first menu */
    document.getElementById('primal-addcmslink').addEventListener('click', function (e) {
        appendMenuItem("cms");
    });
    
    if (document.querySelector('.cms-input ul') !== null) {
        var menuItems = document.querySelectorAll('.cms-input ul');
        
        Array.prototype.forEach.call(menuItems, function (el, i) {
            el.addEventListener('click', function(e) {
                var elLi = e.target.parentNode.parentNode;
                
                switch(e.target.className) {
                    case "primal-icon-calendar d-title":
                        if ( elLi.getAttribute('data-rel') == 'true' ) {
                            elLi.setAttribute('data-rel', 'false');
                        } else {
                            elLi.setAttribute('data-rel', 'true');
                        }
                        break;
                    case "primal-icon-windows d-title":
                        if ( elLi.getAttribute('data-target') == 'true' ) {
                            elLi.setAttribute('data-target', 'false');
                        } else {
                            elLi.setAttribute('data-target', 'true');
                        }
                        break;
                    case "primal-icon-trash d-title":
                        if ( confirm("Na pewno chcesz usunąć ten element?") ) {
                            elLi.parentNode.removeChild(elLi);
                        }
                        break;
                } 
            });
        });
     }
    
    /* Textarea */
    if (document.querySelector('#primal-admin-panel textarea') !== null) {
        var textareas = document.querySelectorAll('#primal-admin-panel textarea');
        
        Array.prototype.forEach.call(textareas, function (el, i) {
            el.addEventListener('keyup', function(e) {
                
                el.parentNode.setAttribute('data-characters', el.value.length+' z.');
            });
        });
     }
    
    /* Adding checkbox property to tabs radio */
    if (document.querySelector('.primal-tab-label') !== null) {
        var primalTabLabels = document.querySelectorAll('.primal-tab-label');
        
        Array.prototype.forEach.call(primalTabLabels, function (el, i) {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                var adminTab = e.target.getAttribute('for');
                document.getElementById(adminTab).checked = !document.getElementById(adminTab).checked;
            });
        });
     }

    /* JS safe check */
    ('input blur'.split(" ")).forEach(function (eventtype) {
        document.getElementById('primal-admin-panel').addEventListener(eventtype, function (e) {
            if (e.target.getAttribute('data-check') == 'true') {
                primalCheckThis(e.target.length); 
            }
        }, true);
    });

    /* Ctrl + S to save */
    document.addEventListener('keydown', function (e) {
        // !e.altKey because FF for some reason trigger that with Ctrl
        if (e.ctrlKey && !e.altKey && e.keyCode === 83) {
            e.preventDefault();
            var editPageForm = document.getElementById('primal-edit-page-form');

            var event = document.createEvent('HTMLEvents');
            event.initEvent('submit', true, true);

            editPageForm.dispatchEvent(event);

            return false;
        }
    });;

    /* Reaction */
    primal.reactionBox.addEventListener('click', hideReaction);
});

//.primal-menu-input
