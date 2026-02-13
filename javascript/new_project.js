document.querySelector('.btn-add-tech').addEventListener('click', function() {
    const input = document.getElementById('technologies');
    const techValue = input.value.trim();
    
    if (techValue) {
        const techList = document.getElementById('tech-list');
        const techBadge = document.createElement('span');
        techBadge.className = 'tech-badge';
        techBadge.innerHTML = techValue + ' <button type="button" class="tech-remove">×</button>';
        
        techList.appendChild(techBadge);
        input.value = '';
        
        techBadge.querySelector('.tech-remove').addEventListener('click', function() {
            techBadge.remove();
        });
    }
});

document.getElementById('technologies').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        document.querySelector('.btn-add-tech').click();
    }
});

document.getElementById('submitform').addEventListener('submit', function(e) {
    e.preventDefault();
    
    let isValid = true;
    
    const nomProjet = document.getElementById('nom_projet');
    const projectError = document.getElementById('project_name_error');
    if (!nomProjet.value.trim()) {
        projectError.classList.remove('titanic');
        isValid = false;
    } else {
        projectError.classList.add('titanic');
    }
    
    const client = document.getElementById('client');
    const clientError = document.getElementById('client_name_error');
    if (client.value === '-- Sélectionner --' || !client.value) {
        clientError.classList.remove('titanic');
        isValid = false;
    } else {
        clientError.classList.add('titanic');
    }
    
    const startDate = document.getElementById('start_date');
    if (!startDate.value) {
        isValid = false;
    }
    
    if (isValid) {
        window.location.href = 'project.php';
    }
});