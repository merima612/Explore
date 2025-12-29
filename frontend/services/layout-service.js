var LayoutService = {
    generateMenuItems: function() {
        const user = UserService.getCurrentUser();
        if (!user || !user.role) {
            window.location.replace("login.html");
            return;
        }
        
        let nav = "";
        let main = "";
        
        switch(user.role) {
            case Constants.USER_ROLE:
                nav = this.getUserNav();
                main = this.getUserMain();
                break;
            case Constants.ADMIN_ROLE:
                nav = this.getAdminNav();
                main = this.getAdminMain();
                break;
        }
        
        $("#tabs").html(nav);
        $("#spapp").html(main);
    },
    
    getUserNav: function() {
        return `<li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#list">Users</a>
                </li>
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#accommodation">Accommodation</a>
                </li>
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#forms">Forms</a>
                </li>
                <li>
                    <button class="btn btn-primary" onclick="AuthService.logout()">Logout</button>
                </li>`;
    },
/*
    getAdminNav: function() {
    return `
        <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#users">Users List</a>
        </li>
        `;
}
*/
};