import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, router, useForm } from "@inertiajs/react";
import { createColumnHelper } from "@tanstack/react-table";
import { GenericTable } from "@/Components/GenericTable";
import { Button } from "@/components/ui/button";
import { useState, useEffect } from "react";
import { Pencil, Trash2 } from "lucide-react";
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
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import EditRTModal from "@/Components/EditRTModal";
import Swal from "sweetalert2";


const KelolaRT = ({ datas }) => {
    // console.log(datas);
    
    const { data, setData, post, processing, errors, reset } = useForm({
        nomor_rt: "",
        nama_rt: "",
        alamat_rt: "",
        nomor_hp: "",
        is_active: true,
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
    const columnHelper = createColumnHelper();
    const column = [
        columnHelper.accessor("nomor_rt", {
            header: "Nomor RT",
            cell: (info) => (
                <span className="font-medium">{info.getValue()}</span>
            ),
        }),
        columnHelper.accessor("nama_rt", {
            header: "Nama RT",
            cell: (info) => (
                <span className="text-gray-700">{info.getValue()}</span>
            ),
        }),
        columnHelper.accessor("alamat_rt", {
            header: "Alamat RT",
            cell: (info) => (
                <span className="text-gray-700">{info.getValue()}</span>
            ),
        }),
        columnHelper.accessor("nomor_hp", {
            header: "Nomor HP",
            cell: (info) => (
                <span className="text-gray-700">{info.getValue()}</span>
            ),
        }),
        columnHelper.accessor("is_active", {
            header: "Status Aktif",
            cell: (info) => (
                <span
                    className={`${info.getValue() ? "bg-green-600" : "bg-red-600"}  py-1 px-2  rounded text-xs  text-white `}
                >
                    {info.getValue() ? "Aktif" : "Tidak Aktif"}
                </span>
            ),
        }),
        columnHelper.display({
            id: "actions",
            header: "Aksi",
            cell: ({ row }) => {
                const [showEditModal, setShowEditModal] = useState(false);
                // console.log("row:", row.original.id);
                return (
                    <div className="flex space-x-2">
                        <Button
                            variant="outline"
                            className="bg-gray-200"
                            size="icon"
                            onClick={() => setShowEditModal(true)}
                        >
                            <Pencil className="h-4 w-4" />
                        </Button>
                        <Button
                            variant="destructive"
                            size="icon"
                            onClick={(e) => {
                                // console.log(row.original.id_rt)
                                // e.stopPropagation();
                                // handleDelete(row.original.id);
                                Swal.fire({
                                    title: "yakin ingin menghapus ini ?",
                                    showConfirmButton: true,
                                    showCancelButton: true,
                                    confirmButtonText: "Ya",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Swal.fire("Saved!", "", "success");
                                        router.delete(
                                            route(
                                                "rt.destroy",
                                                row.original.id_rt
                                            ),
                                            {
                                                onSuccess: () => {
                                                    Toast.fire({
                                                        icon: "success",
                                                        title: "Berhasil dihapus",
                                                    });
                                                },
                                            }
                                        );
                                    }
                                });
                                // if (confirm("yakin ingin menghapus ini ?")) {
                                // }
                            }}
                        >
                            <Trash2 className="h-4 w-4" />
                        </Button>
                        {showEditModal && (
                            <EditRTModal
                                rt={row.original}
                                onClose={() => setShowEditModal(false)}
                            />
                        )}
                    </div>
                );
            },
        }),
    ];

    // useEffect(() => {
    //     console.log("Data state updated:", data);
    // }, [data]);
    const handleSubmit = (e) => {
        e.preventDefault();
        // console.log("Data yang akan di store:", data);
        post(route("rt.store"), {
            onSuccess: () => {
                reset();
                Toast.fire({
                    icon: "success",
                    title: "Berhasil menyimpan",
                });
                document.getElementById("closeDialog").click();
            },
            onError: (e) => {
                // Swal.fire({
                //     icon: "error",
                //     title: "Gagal menyimpan",
                //     text: Object.values(e).join("\n"),
                // });
            },
        });
    };
    const handleResetForm = () => {
        setData({
            nomor_rt: "",
            nama_rt: "",
            alamat_rt: "",
            nomor_hp: "",
            is_active: true,
        });
        // console.log(data);
    };
    const handleRowClick = (staff) => {
        // console.log(data);
        // setData(staff);
        // console.log("Staff dipilih:", data);
        // Navigasi ke halaman detail atau modal
        // router.push(`/staff/${staff.id}`);
    };

    return (
        <AuthenticatedLayout headerName="Kelola RT">
            <Head title="Kelola RT" />

            <div className="container mx-auto py-8">
                <div className="flex justify-between  items-center mb-6">
                    <div>

                    <h1 className="text-2xl font-bold text-gray-800">Data RT</h1>
                    <p className="text-gray-600 ">Lihat dan kelola semua laporan bulanan RT</p>
                    </div>
                    <Dialog>
                        <form>
                            <DialogTrigger asChild>
                                <Button
                                    variant="default"
                                    onClick={handleResetForm}
                                >
                                    Tambah RT
                                </Button>
                            </DialogTrigger>
                            <DialogContent className="sm:max-w-[525px]">
                                <DialogHeader>
                                    <DialogTitle>Tambah Data RT</DialogTitle>
                                    <DialogDescription>
                                        Isi form berikut untuk menambahkan RT
                                        baru.
                                    </DialogDescription>
                                </DialogHeader>
                                <div className="grid gap-4">
                                    <div className="grid gap-3">
                                        <Label htmlFor="nama_rt">Nama RT</Label>
                                        <Input
                                            id="nama_rt"
                                            name="nama_rt"
                                            value={data.nama_rt}
                                            onChange={(e) =>
                                                setData(
                                                    "nama_rt",
                                                    e.target.value
                                                )
                                            }
                                            placeholder="contoh : Pedro Duarte"
                                        />
                                        {errors.nama_rt && (
                                            <p className="text-sm text-red-500">
                                                {errors.nama_rt}
                                            </p>
                                        )}
                                    </div>
                                    <div className="flex flex-wrap justify-between gap-2">
                                        <div className="">
                                            <Label htmlFor="nomor_rt">
                                                Nomor RT 
                                            </Label>
                                            <Input
                                                type="text" // Ubah dari number ke text
                                                inputMode="numeric" // Tetap tampilkan keyboard numerik di mobile
                                                pattern="[0-9]*"
                                                id="nomor_rt"
                                                name="nomor_rt"
                                                value={data.nomor_rt}
                                                onChange={(e) =>
                                                    setData(
                                                        "nomor_rt",
                                                        e.target.value
                                                    )
                                                }
                                                placeholder="contoh : 01"
                                            />
                                            {errors.nomor_rt && (
                                                <p className="text-sm text-red-500">
                                                    {errors.nomor_rt}
                                                </p>
                                            )}
                                        </div>
                                        <div className="">
                                            <Label htmlFor="nomor_hp">
                                                Nomor Hp (opsional)
                                            </Label>
                                            <Input
                                                type="text" // Ubah dari number ke text
                                                inputMode="numeric" // Tetap tampilkan keyboard numerik di mobile
                                                pattern="[0-9+ \-]*"
                                                id="nomor_hp"
                                                name="nomor_hp"
                                                value={data.nomor_hp}
                                                onChange={(e) =>
                                                    setData(
                                                        "nomor_hp",
                                                        e.target.value
                                                    )
                                                }
                                                // defaultValue="01"
                                                placeholder="contoh : 08123456789"
                                            />
                                            {errors.nomor_hp && (
                                                <p className="text-sm text-red-500">
                                                    {errors.nomor_hp}
                                                </p>
                                            )}
                                        </div>
                                    </div>
                                    <div className="grid gap-3 ">
                                        <Label htmlFor="alamat_rt">
                                            Alamat RT (opsional)
                                        </Label>
                                        <Input
                                            id="alamat_rt"
                                            name="alamat_rt"
                                            value={data.alamat_rt}
                                            onChange={(e) =>
                                                setData(
                                                    "alamat_rt",
                                                    e.target.value
                                                )
                                            }
                                            // defaultValue="Jl. Raya No. 1"
                                            placeholder="contoh : Jl. Raya No. 1"
                                        />
                                        {errors.alamat_rt && (
                                            <p className="text-sm text-red-500">
                                                {errors.alamat_rt}
                                            </p>
                                        )}
                                    </div>
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
                                    <Button
                                        type="submit"
                                        onClick={(e) => {
                                            e.preventDefault();
                                            handleSubmit(e);
                                        }}
                                    >
                                        simpan
                                    </Button>
                                </DialogFooter>
                            </DialogContent>
                        </form>
                    </Dialog>
                </div>
                <GenericTable
                    data={datas}
                    columns={column}
                    onRowClick={handleRowClick}
                    pageSize={5}
                />
                <div className="mt-4 text-sm text-gray-500">
                    Total {datas.length} RT terdaftar
                </div>
                
            </div>

        </AuthenticatedLayout>
    );
};

export default KelolaRT;
