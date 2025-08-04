import { ScrollArea } from "@/components/ui/scroll-area";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";

export default function Dashboard(props) {
    return (
        <AuthenticatedLayout headerName="Dashboard" routeUser={props.routeUser}>
            <Head title="Dashboard" />

            <div className="bg-white rounded-lg shadow p-6">
                <h1 className="text-2xl font-bold mb-4">Dashboard</h1>
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {/* Card 1 */}
                    <div className="bg-blue-50 p-4 rounded-lg">
                        <h2 className="text-lg font-semibold">Total Pengguna</h2>
                        <p className="text-3xl font-bold mt-2">1,248</p>
                    </div>
                    
                    {/* Card 2 */}
                    <div className="bg-green-50 p-4 rounded-lg">
                        <h2 className="text-lg font-semibold">Kegiatan Terbaru</h2>
                        <p className="text-3xl font-bold mt-2">24</p>
                    </div>
                    
                    {/* Card 3 */}
                    <div className="bg-yellow-50 p-4 rounded-lg">
                        <h2 className="text-lg font-semibold">Pendaftar Baru</h2>
                        <p className="text-3xl font-bold mt-2">12</p>
                    </div>
                </div>
                
                <div className="mt-8">
                    <h2 className="text-xl font-semibold mb-4">Aktivitas Terbaru</h2>
                    <div className="bg-gray-50 p-4 rounded-lg">
                        <ul className="space-y-3">
                            <li className="flex items-center justify-between border-b pb-2">
                                <span>Pengguna baru mendaftar</span>
                                <span className="text-sm text-gray-500">2 jam lalu</span>
                            </li>
                            <li className="flex items-center justify-between border-b pb-2">
                                <span>Kegiatan desa diperbarui</span>
                                <span className="text-sm text-gray-500">5 jam lalu</span>
                            </li>
                            <li className="flex items-center justify-between border-b pb-2">
                                <span>Laporan bulanan diunggah</span>
                                <span className="text-sm text-gray-500">1 hari lalu</span>
                            </li>
                        </ul>
                    </div>
                </div>

                
            </div>
        </AuthenticatedLayout>
    );
}
