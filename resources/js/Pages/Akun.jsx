import { Head } from "@inertiajs/react";
import AkunLayout from "@/Layouts/AkunLayout";
import { StaffAccountTable } from "@/Components/StaffAccountTable";
import { Button } from "@/components/ui/button";
import { useState } from "react";
import { createColumnHelper } from "@tanstack/react-table";
import { GenericTable } from "@/Components/GenericTable";
import { Pencil, Trash2 } from "lucide-react";

const staffData = [
    {
        id: 1,
        name: "Admin Utama",
        email: "admin@desa.sc",
        role: "Super Admin",
        assignedRT: ["Semua RT"],
        lastLogin: "2025-07-15T14:30:00Z",
    },
    {
        id: 2,
        name: "Budi Santoso",
        email: "budi@desa.sc",
        role: "Moderator",
        assignedRT: ["RT1", "RT2"],
        lastLogin: "2025-07-14T09:15:00Z",
    },
    {
        id: 3,
        name: "Siti Rahayu",
        email: "siti@desa.sc",
        role: "Moderator",
        assignedRT: ["RT3", "RT4"],
        lastLogin: "2025-07-10T16:45:00Z",
    },
    {
        id: 3,
        name: "Siti Rahayu",
        email: "siti@desa.sc",
        role: "Moderator",
        assignedRT: ["RT3", "RT4"],
        lastLogin: "2025-07-10T16:45:00Z",
    },
    {
        id: 3,
        name: "Siti Rahayu",
        email: "siti@desa.sc",
        role: "Moderator",
        assignedRT: ["RT3", "RT4"],
        lastLogin: "2025-07-10T16:45:00Z",
    },
    {
        id: 3,
        name: "Siti Rahayu",
        email: "siti@desa.sc",
        role: "Moderator",
        assignedRT: ["RT3", "RT4"],
        lastLogin: "2025-07-10T16:45:00Z",
    },
    {
        id: 3,
        name: "Siti Rahayu",
        email: "siti@desa.sc",
        role: "Moderator",
        assignedRT: ["RT3", "RT4"],
        lastLogin: "2025-07-10T16:45:00Z",
    },
    {
        id: 3,
        name: "Siti Rahayu",
        email: "siti@desa.sc",
        role: "Moderator",
        assignedRT: ["RT3", "RT4"],
        lastLogin: "2025-07-10T16:45:00Z",
    },
    {
        id: 3,
        name: "Siti Rahayu",
        email: "siti@desa.sc",
        role: "Moderator",
        assignedRT: ["RT3", "RT4"],
        lastLogin: "2025-07-10T16:45:00Z",
    },
];

const Akun = (props) => {
    const [data, setData] = useState([props.users || staffData]);
    console.log(props);
    // Handler untuk penghapusan
    const handleDelete = (staffId) => {
        setData(data.filter((staff) => staff.id !== staffId));
    };

    // Konfigurasi kolom khusus untuk halaman ini
    const columnHelper = createColumnHelper();
    const columns = [
        columnHelper.accessor("name", {
            header: "Nama",
            cell: (info) => (
                <span className="font-medium">{info.getValue()}</span>
            ),
        }),
        columnHelper.accessor("email", {
            header: "Email",
            cell: (info) => (
                <span className="text-blue-600">{info.getValue()}</span>
            ),
        }),
        columnHelper.accessor("role", {
            header: "Role",
            cell: (info) => (
                <span
                    className={`px-2 py-1 rounded-full text-xs ${
                        info.getValue() === "Super Admin"
                            ? "bg-purple-100 text-purple-800"
                            : "bg-blue-100 text-blue-800"
                    }`}
                >
                    {info.getValue()}
                </span>
            ),
        }),
        columnHelper.accessor("assignedRT", {
            header: "RT Bertanggung Jawab",
            cell: (info) => {
                const value = info.getValue();
                const rtArray = Array.isArray(value)
                    ? value
                    : [value || "Tidak ada RT"];
                console.log(rtArray);

                return (
                    <div className="flex flex-wrap gap-1">
                        {rtArray.map((rt, index) => (
                            <span
                                key={index}
                                className="bg-green-100 text-green-800 px-2 py-1 rounded text-xs"
                            >
                                {rt}
                            </span>
                        ))}
                    </div>
                );
            },
        }),
        columnHelper.accessor("last_login", {
            header: "Terakhir Login",
            cell: (info) => (
                <span className="text-gray-500 text-sm">
                    {new Date(info.getValue()).toLocaleString()}
                </span>
            ),
        }),
        columnHelper.display({
            id: "actions",
            header: "Aksi",
            cell: ({ row }) => (
                <div className="flex space-x-2">
                    <Button variant="outline" size="icon">
                        <Pencil className="h-4 w-4" />
                    </Button>
                    <Button
                        variant="destructive"
                        size="icon"
                        onClick={(e) => {
                            e.stopPropagation();
                            handleDelete(row.original.id);
                        }}
                    >
                        <Trash2 className="h-4 w-4" />
                    </Button>
                </div>
            ),
        }),
    ];

    // Handler untuk ketika baris diklik
    const handleRowClick = (staff) => {
        console.log("Staff dipilih:", staff);
        // Navigasi ke halaman detail atau modal
        // router.push(`/staff/${staff.id}`);
    };
    return (
        <AkunLayout headerName={"Akun Staff"}>
            <Head title="Akun Staff" />

            <div className="container mx-auto py-8">
                <div className="flex justify-between items-center mb-6">
                    <h1 className="text-2xl font-bold">Akun Staff</h1>
                    <Button variant="default">Tambah Staff</Button>
                </div>
                <GenericTable
                    data={props.users || staffData}
                    columns={columns}
                    onRowClick={handleRowClick}
                    pageSize={5}
                />
                <div className="mt-4 text-sm text-gray-500">
                    Total {staffData.length} akun staff terdaftar
                </div>
            </div>
        </AkunLayout>
    );
};

export default Akun;
