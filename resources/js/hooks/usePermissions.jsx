import { usePage } from '@inertiajs/react'

export const usePermissions = () => {
    const { auth } = usePage().props
    
    const isSuperAdmin = auth.user?.role === 'super_admin'
    const isModerator = auth.user?.role === 'moderator'
    // const isStaff = auth.user?.role === 'staff'

    const can = (permission) => {
        if (isSuperAdmin) return true
        
        const permissions = {
            moderator: [
                'create.laporan', 'view.laporan', 'edit.laporan', 'delete.laporan',
                'create.kegiatan', 'view.kegiatan', 'edit.kegiatan', 'delete.kegiatan',
                'create.agama', 'view.agama', 'edit.agama', 'delete.agama',
                'create.karang_taruna', 'view.karang_taruna', 'edit.karang_taruna', 'delete.karang_taruna',
                'create.perangkat_desa', 'view.perangkat_desa', 'edit.perangkat_desa', 'delete.perangkat_desa',
            ],
            
        }

        return permissions[auth.user?.role]?.includes(permission) || false
    }

    return {
        isSuperAdmin,
        isModerator,
     
        can,
        canManageUsers: isSuperAdmin,
        canManageRT: isSuperAdmin,
        canVerifyLaporan: isSuperAdmin,
        canCreateLaporan: isModerator || isSuperAdmin,
        canCreateKegiatan: isModerator || isSuperAdmin,
        canCreateAgama: isModerator || isSuperAdmin,
        canCreateKarangTaruna: isModerator || isSuperAdmin,
    }
}

