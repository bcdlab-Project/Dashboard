function NameRole(role) {
    switch (role) {
        case 'administrator':
            return 'Administrator';
        case 'collaborator':
            return 'Collaborator';
        case 'code_reviewer':
            return 'Code Reviewer';
        case 'developer':
            return 'Developer';
        default:
            return false;
    }
}