const editBtn = document.getElementById('edit-btn');

const formTableEl = document.getElementById('form-table');
const formRowEl = document.getElementsByClassName('form-row');
const rowCheckboxes = document.getElementsByClassName('form-row-checkbox');

const optionsEl = document.getElementById('options-el');

const addSubjectsMenu = document.getElementById('add-subjects-menu');

const addSubBtn = document.getElementById('add-subject-btn');
const cancelSubBtn = document.getElementById('cancel-sub-btn');
const removeSubsBtn = document.getElementById('remove-subjects-btn');

const formCheckbox = document.getElementById('form-checkbox-main');

const editOnIcon = document.getElementById('edit-on-icon');
const editOffIcon = document.getElementById('edit-off-icon');
editBtn.addEventListener('click', () => {
    if (editOnIcon.classList.contains('hidden') && !addSubjectsMenu.classList.contains('hidden')) {
        cancelSubBtn.click();
    }
    editOnIcon.classList.toggle('hidden');
    editOffIcon.classList.toggle('hidden');
    formCheckbox.classList.toggle('hidden');
    for (let i = 0; i < rowCheckboxes.length; i++) {
        rowCheckboxes[i].classList.toggle('hidden');
    }
    optionsEl.classList.toggle('hidden');
    optionsEl.classList.toggle('flex');
})

addSubBtn.addEventListener('click', () => {
    formTableEl.classList.add('hidden');
    addSubjectsMenu.classList.remove('hidden');
});

cancelSubBtn.addEventListener('click', () => {
    formTableEl.classList.remove('hidden');
    addSubjectsMenu.classList.add('hidden');
});

function post(path, params, method='post') {
    const form = document.createElement('form');
    form.method = method;
    form.action = path;

    for (let i = 0; i < params.length; i++) {
        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = 'remove[' + i + ']';
        hiddenField.value = params[i];

        form.appendChild(hiddenField);
    }
  
    document.body.appendChild(form);
    form.submit();
}

removeSubsBtn.addEventListener('click', () => {
    let rows = [...rowCheckboxes];
    let subIdsArray = [];
    for (let i = 0; i < rows.length; i++) {
        if (rows[i].checked === true) {
            subIdsArray.push(rows[i].getAttribute('name'));
        }
    }
    post('profile.php', subIdsArray);
});

formCheckbox.addEventListener('click', () => {
    for (let i = 0; i < rowCheckboxes.length; i++) {
        if (formCheckbox.checked === true) rowCheckboxes[i].checked = true;
        else rowCheckboxes[i].checked = false;
    }
});

const numRowsInput = document.getElementById('num-rows-input');
const subRowsUl = document.getElementById('sub-rows-ul');
const subRowsLis = document.getElementsByClassName('sub-row-li');

const subRowCopy = subRowsLis[0].cloneNode(true);
let prevVal = numRowsInput.value;

numRowsInput.addEventListener('change', (e) => {
    subRowsUl.innerHTML = '';
    for (let i = 0; i < e.target.value; i++) {
        const newSubRowCopy = subRowCopy.cloneNode(true);
        subRowsUl.append(newSubRowCopy);
    }
})