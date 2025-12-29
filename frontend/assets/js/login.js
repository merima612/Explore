function toggleAdminCredentials() {

    document.getElementById('userCredentials').style.display = 'none';
    

    const adminCreds = document.getElementById('adminCredentials');
    if (adminCreds.style.display === 'none') {
        adminCreds.style.display = 'block';
        adminCreds.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    } else {
        adminCreds.style.display = 'none';
    }
}

function toggleUserCredentials() {

    document.getElementById('adminCredentials').style.display = 'none';
    
    const userCreds = document.getElementById('userCredentials');
    if (userCreds.style.display === 'none') {
        userCreds.style.display = 'block';
        userCreds.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    } else {
        userCreds.style.display = 'none';
    }
}

function hideAdminCreds() {
    document.getElementById('adminCredentials').style.display = 'none';
}

function hideUserCreds() {
    document.getElementById('userCredentials').style.display = 'none';
}
