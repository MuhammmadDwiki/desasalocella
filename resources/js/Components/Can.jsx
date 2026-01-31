import { usePermissions } from '@/hooks/usePermissions'

const Can = ({ 
    children, 
    permission, 
    permissions = [],
    superAdmin = true 
}) => {
    const { can, isSuperAdmin } = usePermissions()
    
    if (superAdmin && isSuperAdmin) {
        return children;
    }
    
    if (permission && can(permission)) {
        return children;
    }
    
    if (permissions.length > 0 && permissions.some(p => can(p))) {
        return children;
    }
    
    return null;
}

export default Can