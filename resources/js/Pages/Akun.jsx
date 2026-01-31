import { Head, router, useForm } from "@inertiajs/react";
import { useState } from "react";

import AkunLayout from "@/Layouts/AkunLayout";
import { StaffAccountTable } from "@/Components/StaffAccountTable";
import { Button } from "@/components/ui/button";
import { createColumnHelper } from "@tanstack/react-table";
import { GenericTable } from "@/Components/GenericTable";
import { Pencil, Trash2 } from "lucide-react";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { AlertTriangle, PlusCircle, AlertCircle } from "lucide-react";

import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import Swal from "sweetalert2";


const Akun = ({ users, rt }) => {
    const [showEditModal, setShowEditModal] = useState(false);
    const [editingUserId, setEditingUserId] = useState(null);

    // console.log(users);
    const {
        data: createData,
        setData: setCreateData,
        post,
        processing: creating,
        errors: createErrors,
        reset: resetCreate,
        setError,
    } = useForm({
        username: "",
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        id_rt: "",
    });

    // Form for editing existing data
    const {
        data: editFormData,
        setData: setEditFormData,
        put,
        processing: updating,
        errors: updateErrors,
        reset: resetEdit,
    } = useForm({
        id: "",
        username: "",
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        id_rt: "",
    });

    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
    });

    // Konfigurasi kolom khusus untuk halaman ini
    const columnHelper = createColumnHelper();
    const columns = [
        columnHelper.accessor("username", {
            header: "Username",
            cell: (info) => <span className="">{info.getValue()}</span>,
        }),
        columnHelper.accessor("name", {
            header: "Nama",
            cell: (info) => <span className="">{info.getValue()}</span>,
        }),
        columnHelper.accessor("email", {
            header: "Email",
            cell: (info) => <span className="">{info.getValue()}</span>,
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
        columnHelper.accessor("nomor_rt", {
            header: "Bertanggung Jawab RT ",
            cell: (info) => {
                const value = info.getValue();
                const rtArray = Array.isArray(value)
                    ? value
                    : [value || "Tidak ada RT"];

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
                    {/* {new Date(info.getValue()).toLocaleString()} */}
                    {info.getValue() == null
                        ? "-"
                        : new Date(info.getValue()).toLocaleString()}
                </span>
            ),
        }),
        columnHelper.display({
            id: "actions",
            header: "Aksi",
            cell: ({ row }) => {
                return (
                    <div className="flex space-x-2">
                        <Button
                            variant="outline"
                            size="icon"
                            onClick={() => {
                                console.log(row.original);
                                setEditingUserId(row.original.id);
                                setShowEditModal(true);
                                setEditFormData({
                                    id: row.original.id,
                                    username: row.original.username,
                                    name: row.original.name,
                                    email: row.original.email,
                                    password: "",
                                    password_confirmation: "",
                                    id_rt: row.original.id_rt,
                                });
                            }}
                        >
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
                );
            },
        }),
    ];

    // Handler untuk ketika baris diklik
    const handleRowClick = (staff) => {};

    const handleCreate = (e) => {
        e.preventDefault();
        console.log(createData);
        const isMatch =
            createData.password === createData.password_confirmation;
        if (!isMatch) {
            setError("password_confirmation", "konfirmasi password tidak sama");
            return;
        }

        post(route("users.store"), {
            onSuccess: () => {
                resetCreate();
                Toast.fire({
                    icon: "success",
                    title: "Data berhasil ditambahkan",
                });
                document.getElementById("closeDialog").click();
            },
            onError: (e) => {
                console.log(e);
                Toast.fire({
                    icon: "error",
                    title: "Data gagal ditambahkan",
                });
            },
        });
    };

    const handleUpdate = (e) => {
        e.preventDefault();
        console.log(editFormData);
        if (
            editFormData.password &&
            editFormData.password !== editFormData.password_confirmation
        ) {
            Toast.fire({
                icon: "error",
                title: "Konfirmasi password tidak sama",
            });
            return;
        }
        const dataToUpdate = { ...editFormData };
        if (!dataToUpdate.password) {
            delete dataToUpdate.password;
            delete dataToUpdate.password_confirmation;
        }
        put(route("users.update", editingUserId), {
            data: dataToUpdate,
            onSuccess: () => {
                Toast.fire({
                    icon: "success",
                    title: "Data berhasil diupdate",
                });
                setShowEditModal(false);
                resetEdit();
            },
            onError: () => {
                Toast.fire({
                    icon: "error",
                    title: "Data gagal diupdate",
                });
            },
        });
    };

    const handleDelete = (id) => {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(route("users.destroy", id), {
                    onSuccess: () => {
                        Toast.fire({
                            icon: "success",
                            title: "Data berhasil dihapus",
                        });
                    },
                    onError: () => {
                        Toast.fire({
                            icon: "error",
                            title: "Data gagal dihapus",
                        });
                    },
                });
            }
        });
    };
    return (
        <AkunLayout headerName={"Akun Staff"}>
            <Head title="Akun Staff" />

            <div className="container mx-auto py-8">
                <div className="flex justify-between items-center mb-6">
                    <h1 className="text-2xl font-bold">Akun Staff</h1>
                    <Dialog>
                        <DialogTrigger asChild>
                            <Button
                                variant="default"
                                // onClick={() => resetCreate()}
                            >
                                Tambah Akun
                            </Button>
                        </DialogTrigger>
                        <DialogContent className="sm:max-w-[525px] max-h-[75vh]">
                            <DialogHeader>
                                <DialogTitle className="capitalize">
                                    Tambah Akun staff
                                </DialogTitle>
                                <DialogDescription>
                                    Isi form berikut untuk menambahkan data
                                    baru.
                                </DialogDescription>
                            </DialogHeader>
                            <form onSubmit={handleCreate} className="space-y-4">
                                <div className="flex flex-col gap-2 w-full">
                                    <label className="block text-sm font-medium text-gray-700">
                                        Username
                                    </label>
                                    <Input
                                        type="text"
                                        value={createData.username}
                                        onChange={(e) =>
                                            setCreateData(
                                                "username",
                                                e.target.value
                                            )
                                        }
                                        placeholder="Username"
                                    />
                                    {createErrors.username && (
                                        <p className="mt-1 text-sm text-red-600">
                                            {createErrors.username}
                                        </p>
                                    )}
                                </div>

                                <div className="flex flex-col gap-2 w-full">
                                    <label className="block text-sm font-medium text-gray-700">
                                        Nama lengkap
                                    </label>
                                    <Input
                                        value={createData.name}
                                        onChange={(e) =>
                                            setCreateData(
                                                "name",
                                                e.target.value
                                            )
                                        }
                                        placeholder="nama lengkap"
                                    />
                                    {createErrors.name && (
                                        <p className="mt-1 text-sm text-red-600">
                                            {createErrors.name}
                                        </p>
                                    )}
                                </div>

                                <div className="flex flex-col gap-2 w-full">
                                    <label
                                        htmlFor="id_rt"
                                        className="block text-sm font-medium text-gray-700"
                                    >
                                        Bertanggung jawab pada RT
                                    </label>
                                    <Select
                                        onValueChange={(value) =>
                                            setCreateData("id_rt", value)
                                        }
                                        value={createData.id_rt}
                                    >
                                        <SelectTrigger>
                                            <SelectValue
                                                placeholder={
                                                    rt.length === 0
                                                        ? "Data RT kosong (tidak bisa dipilih)"
                                                        : "Pilih RT"
                                                }
                                            />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {rt.map((rt) => (
                                                <SelectItem
                                                    key={rt.id_rt}
                                                    value={rt.id_rt}
                                                >
                                                    RT {rt.nomor_rt}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                    {rt.length === 0 && (
                                        <div className="flex items-center gap-2 mt-1 text-sm text-yellow-600">
                                            <AlertCircle className="w-4 h-4" />
                                            <span>
                                                Harap tambah data RT terlebih
                                                dahulu{" "}
                                                <a
                                                    href="/manage-rt"
                                                    className="text-blue-500 hover:underline"
                                                >
                                                    disini.
                                                </a>
                                            </span>
                                        </div>
                                    )}
                                </div>

                                <div className="flex flex-col gap-2 w-full">
                                    <label className="block text-sm font-medium text-gray-700">
                                        Email
                                    </label>
                                    <Input
                                        value={createData.email}
                                        type="email"
                                        onChange={(e) =>
                                            setCreateData(
                                                "email",
                                                e.target.value
                                            )
                                        }
                                        placeholder="email"
                                    />
                                    {createErrors.email && (
                                        <p className="mt-1 text-sm text-red-600">
                                            {createErrors.email}
                                        </p>
                                    )}
                                </div>
                                <div className="flex flex-col gap-2 w-full">
                                    <label className="block text-sm font-medium text-gray-700">
                                        Password
                                    </label>
                                    <Input
                                        value={createData.password}
                                        type="password"
                                        onChange={(e) =>
                                            setCreateData(
                                                "password",
                                                e.target.value
                                            )
                                        }
                                        placeholder="password"
                                    />
                                    {createErrors.password && (
                                        <p className="mt-1 text-sm text-red-600">
                                            {createErrors.password}
                                        </p>
                                    )}
                                </div>
                                <div className="flex flex-col gap-2 w-full">
                                    <label className="block text-sm font-medium text-gray-700">
                                        Konfirmasi Password
                                    </label>
                                    <Input
                                        value={createData.password_confirmation}
                                        type="password"
                                        onChange={(e) =>
                                            setCreateData(
                                                "password_confirmation",
                                                e.target.value
                                            )
                                        }
                                        placeholder="Konfirmasi Password"
                                    />
                                    {createErrors.password_confirmation && (
                                        <p className="mt-1 text-sm text-red-600">
                                            {createErrors.password_confirmation}
                                        </p>
                                    )}
                                </div>
                                <DialogFooter>
                                    <DialogClose asChild>
                                        <Button
                                            type="button"
                                            variant="outline"
                                            id="closeDialog"
                                        >
                                            Cancel
                                        </Button>
                                    </DialogClose>
                                    <Button type="submit" disabled={creating}>
                                        {creating ? "Menyimpan..." : "Simpan"}
                                    </Button>
                                </DialogFooter>
                            </form>
                        </DialogContent>
                    </Dialog>
                </div>

                <GenericTable
                    data={users}
                    columns={columns}
                    onRowClick={handleRowClick}
                    pageSize={5}
                />
                <div className="mt-4 text-sm text-gray-500">
                    Total {users.length} akun staff terdaftar
                </div>
            </div>

            {showEditModal && (
                <Dialog open={showEditModal} onOpenChange={setShowEditModal}>
                    <DialogContent className="sm:max-w-[525px]">
                        <DialogHeader>
                            <DialogTitle>Edit Akun Staff</DialogTitle>
                            <DialogDescription>
                                Ubah data akun staff berikut.
                            </DialogDescription>
                        </DialogHeader>
                        <form onSubmit={handleUpdate} className="space-y-4">
                            <input type="hidden" value={editFormData.id} />

                            <div className="flex flex-col gap-2 w-full">
                                <label className="block text-sm font-medium text-gray-700">
                                    Username
                                </label>
                                <Input
                                    type="text"
                                    value={editFormData.username}
                                    onChange={(e) =>
                                        setEditFormData(
                                            "username",
                                            e.target.value
                                        )
                                    }
                                    placeholder="Username"
                                />
                                {updateErrors.username && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.username}
                                    </p>
                                )}
                            </div>

                            <div className="flex flex-col gap-2 w-full">
                                <label className="block text-sm font-medium text-gray-700">
                                    Nama lengkap
                                </label>
                                <Input
                                    value={editFormData.name}
                                    onChange={(e) =>
                                        setEditFormData("name", e.target.value)
                                    }
                                    placeholder="Nama lengkap"
                                />
                                {updateErrors.name && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.name}
                                    </p>
                                )}
                            </div>

                            <div className="flex flex-col gap-2 w-full">
                                <label className="block text-sm font-medium text-gray-700">
                                    Bertanggung jawab pada RT
                                </label>
                                <Select
                                    onValueChange={(value) =>
                                        setEditFormData("id_rt", value)
                                    }
                                    value={editFormData.id_rt || ""}
                                >
                                    <SelectTrigger>
                                        <SelectValue
                                            placeholder={
                                                rt.length === 0
                                                    ? "Data RT kosong"
                                                    : "Pilih RT"
                                            }
                                        />
                                    </SelectTrigger>
                                    <SelectContent>
                                        {rt.map((rtItem) => (
                                            <SelectItem
                                                key={rtItem.id_rt}
                                                value={rtItem.id_rt}
                                            >
                                                RT {rtItem.nomor_rt}
                                            </SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                                {updateErrors.id_rt && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.id_rt}
                                    </p>
                                )}
                            </div>

                            <div className="flex flex-col gap-2 w-full">
                                <label className="block text-sm font-medium text-gray-700">
                                    Email
                                </label>
                                <Input
                                    value={editFormData.email}
                                    type="email"
                                    onChange={(e) =>
                                        setEditFormData("email", e.target.value)
                                    }
                                    placeholder="Email"
                                />
                                {updateErrors.email && (
                                    <p className="mt-1 text-sm text-red-600">
                                        {updateErrors.email}
                                    </p>
                                )}
                            </div>

                            <div className="border-t pt-4">
                                <h3 className="text-sm font-medium text-gray-700 mb-2">
                                    Ubah Password (opsional)
                                </h3>
                                <div className="flex flex-col gap-2 w-full">
                                    <label className="block text-sm font-medium text-gray-700">
                                        Password Baru
                                    </label>
                                    <Input
                                        value={editFormData.password}
                                        type="password"
                                        onChange={(e) =>
                                            setEditFormData(
                                                "password",
                                                e.target.value
                                            )
                                        }
                                        placeholder="Password baru"
                                    />
                                    {updateErrors.password && (
                                        <p className="mt-1 text-sm text-red-600">
                                            {updateErrors.password}
                                        </p>
                                    )}
                                </div>
                                <div className="flex flex-col gap-2 w-full mt-2">
                                    <label className="block text-sm font-medium text-gray-700">
                                        Konfirmasi Password Baru
                                    </label>
                                    <Input
                                        value={
                                            editFormData.password_confirmation
                                        }
                                        type="password"
                                        onChange={(e) =>
                                            setEditFormData(
                                                "password_confirmation",
                                                e.target.value
                                            )
                                        }
                                        placeholder="Konfirmasi password baru"
                                    />
                                    {updateErrors.password_confirmation && (
                                        <p className="mt-1 text-sm text-red-600">
                                            {updateErrors.password_confirmation}
                                        </p>
                                    )}
                                </div>
                            </div>

                            <DialogFooter>
                                <Button
                                    type="button"
                                    variant="outline"
                                    onClick={() => {
                                        setShowEditModal(false);
                                        resetEdit();
                                    }}
                                >
                                    Batal
                                </Button>
                                <Button type="submit" disabled={updating}>
                                    {updating
                                        ? "Mengupdate..."
                                        : "Simpan Perubahan"}
                                </Button>
                            </DialogFooter>
                        </form>
                    </DialogContent>
                </Dialog>
            )}
        </AkunLayout>
    );
};

export default Akun;
