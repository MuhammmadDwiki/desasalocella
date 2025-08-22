import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import {
    Head,
    router,
    useForm as useInertiaForm,
    usePage,
} from "@inertiajs/react";
import { useForm as useReactHookForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import * as z from "zod";
import {
    Form,
    FormControl,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from "@/components/ui/form";
import {
    Dialog,
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
import { GenericTable } from "@/Components/GenericTable";
import { createColumnHelper } from "@tanstack/react-table";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { useState } from "react";
import Swal from "sweetalert2";
import { Pencil, Trash2 } from "lucide-react";

const formSchema = z.object({
    bulan: z.string().min(1, "Bulan harus dipilih"),
    tahun: z
        .string()
        .min(4, "Tahun harus 4 digit")
        .max(4, "Tahun harus 4 digit")
        .regex(/^[0-9]+$/, "Tahun harus angka")
        .refine((val) => parseInt(val) >= 2000 && parseInt(val) <= 2100, {
            message: "Tahun harus antara 2000-2100",
        }),
});

const formSchemaEdit = z.object({
    id_rekap: z.string().min(1, "id_rekap tidak ada"),
    bulan: z.string().min(1, "Bulan harus dipilih"),
    tahun: z
        .string()
        .min(4, "Tahun harus 4 digit")
        .max(4, "Tahun harus 4 digit")
        .regex(/^[0-9]+$/, "Tahun harus angka")
        .refine((val) => parseInt(val) >= 2000 && parseInt(val) <= 2100, {
            message: "Tahun harus antara 2000-2100",
        }),
});

const months = [
    { value: "01", label: "Januari" },
    { value: "02", label: "Februari" },
    { value: "03", label: "Maret" },
    { value: "04", label: "April" },
    { value: "05", label: "Mei" },
    { value: "06", label: "Juni" },
    { value: "07", label: "Juli" },
    { value: "08", label: "Agustus" },
    { value: "09", label: "September" },
    { value: "10", label: "Oktober" },
    { value: "11", label: "November" },
    { value: "12", label: "Desember" },
];

const LaporanBulanan = ({ datas }) => {
    const [open, setOpen] = useState(false);
    const [showEditModal, setShowEditModal] = useState(false);
    const [editingLaporan, setEditingLaporan] = useState(null);

    const { auth } = usePage().props;
    const { post } = useInertiaForm();

    const form = useReactHookForm({
        resolver: zodResolver(formSchema),
        defaultValues: {
            bulan: "",
            tahun: new Date().getFullYear().toString(),
        },
    });

    const formEdit = useReactHookForm({
        resolver: zodResolver(formSchemaEdit),
        defaultValues: {
            id_rekap: "",
            bulan: "",
            tahun: new Date().getFullYear().toString(),
        },
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

    const onSubmit = (data) => {
        const isDuplicate = datas.some(
            (report) =>
                report.bulan === data.bulan && report.tahun === data.tahun
        );

        if (isDuplicate) {
            Toast.fire({
                icon: "error",
                title: `Laporan untuk ${getMonthName(data.bulan)} ${
                    data.tahun
                } sudah ada`,
            });
            return;
        }
        console.log(data)

        post(route("laporan.store", {bulan: data.bulan,tahun: data.tahun}),
        {
            onSuccess: () => {
                Toast.fire({
                    icon: "success",
                    title: `Laporan ${getMonthName(data.bulan)} ${
                        data.tahun
                    } berhasil ditambahkan`,
                });
                form.reset();
                setOpen(false);
            },
            onError: (errors) => {
                console.log(errors)
                Toast.fire({
                    icon: "error",
                    title: "Gagal menambahkan laporan",
                });
            },
        });
    };

    const onEditSubmit = (data) => {
        const isDuplicate = datas.some(
            (report) =>
                report.bulan === data.bulan &&
                report.tahun === data.tahun &&
                report.id_rekap !== data.id_rekap
        );

        if (isDuplicate) {
            Toast.fire({
                icon: "error",
                title: `Laporan untuk ${getMonthName(data.bulan)} ${
                    data.tahun
                } sudah ada`,
            });
            return;
        }

        router.put(
            route("laporan.update", data.id_rekap),
            {
                bulan: data.bulan,
                tahun: data.tahun,
            },
            {
                onSuccess: () => {
                    Toast.fire({
                        icon: "success",
                        title: "Laporan berhasil diupdate",
                    });
                    setEditingLaporan(null);
                    setShowEditModal(false);
                    formEdit.reset();
                },
                onError: (errors) => {
                    Toast.fire({
                        icon: "error",
                        title: "Gagal mengupdate laporan",
                    });
                },
            }
        );
    };

    const getMonthName = (monthNumber) => {
        const month = months.find((m) => m.value === monthNumber);
        return month ? month.label : monthNumber;
    };

    const handleDelete = (id_rekap) => {
        Swal.fire({
            title: "Yakin ingin menghapus laporan ini?",
            text: "Semua detail laporan akan terhapus!",
            icon: "warning",
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(route("laporan.destroy", id_rekap), {
                    onSuccess: () => {
                        Toast.fire({
                            icon: "success",
                            title: "Laporan berhasil dihapus",
                        });
                    },
                    onError: (e) => {
                        console.log(e);
                        Toast.fire({
                            icon: "error",
                            title: "Gagal menghapus laporan",
                        });
                    },
                });
            }
        });
    };

    const columnHelper = createColumnHelper();
    const columns = [
        columnHelper.accessor("id_rekap", {
            header: "ID Rekap",
            cell: (info) => (
                <span className="">
                    <a
                        // href={route("detailLaporanBulanan", info.getValue())}
                        href={route("laporans.show", info.getValue())}

                        className="text-blue-600 uppercase hover:underline"
                    >
                        {info.getValue()}
                    </a>
                </span>
            ),
        }),
        columnHelper.accessor("bulan", {
            header: "Bulan",
            cell: (info) => info.getValue(),
        }),
        columnHelper.accessor("tahun", {
            header: "Tahun",
            cell: (info) => info.getValue(),
        }),
        columnHelper.display({
            id: "actions",
            header: "Aksi",
            cell: ({ row }) => (
                <div className="flex space-x-2">
                    {(auth.user.role === "super_admin" ||
                        auth.user.role === "moderator") && (
                        <>
                            <Button
                                variant="outline"
                                className="bg-gray-200"
                                size="icon"
                                onClick={() => {
                                    const resetData = {
                                        id_rekap: row.original.id_rekap,
                                        bulan: row.original.bulan,
                                        tahun: row.original.tahun.toString(),
                                    };
                                    formEdit.reset(resetData);
                                    setEditingLaporan(row.original);
                                    setShowEditModal(true);
                                }}
                            >
                                <Pencil className="h-4 w-4" />
                            </Button>

                            {/* Hanya super_admin yang bisa hapus laporan utama */}
                            {auth.user.role === "super_admin" && (
                                <Button
                                    variant="destructive"
                                    size="icon"
                                    onClick={() =>
                                        handleDelete(row.original.id_rekap)
                                    }
                                >
                                    <Trash2 className="h-4 w-4" />
                                </Button>
                            )}
                        </>
                    )}
                </div>
            ),
        }),
    ];

    const handleRowClick = (row) => {
        // router.get(route("laporan.show", row.id_rekap));
    };

    return (
        <AuthenticatedLayout headerName="Laporan Bulanan">
            <Head title="Laporan Bulanan" />
            <div className="container mx-auto py-6">
                <div className="flex justify-between items-center mb-6">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-800">
                            Laporan Bulanan
                        </h1>
                        <p className="text-gray-600">
                            Lihat dan kelola semua laporan bulanan RT
                        </p>
                    </div>

                     {(auth.user.role === 'super_admin' || auth.user.role === 'moderator') && (
                   
                        <Dialog open={open} onOpenChange={setOpen}>
                            <DialogTrigger asChild>
                                <Button variant="default">Tambah Laporan</Button>
                            </DialogTrigger>
                            <DialogContent>
                                <DialogHeader>
                                    <DialogTitle>
                                        Tambah Laporan Bulanan
                                    </DialogTitle>
                                    <DialogDescription>
                                        Isi form berikut untuk menambahkan laporan
                                    </DialogDescription>
                                </DialogHeader>

                                <Form {...form}>
                                    <form
                                        onSubmit={form.handleSubmit(onSubmit)}
                                        className="space-y-6"
                                    >
                                        <FormField
                                            control={form.control}
                                            name="bulan"
                                            render={({ field }) => (
                                                <FormItem>
                                                    <FormLabel>Bulan</FormLabel>
                                                    <Select
                                                        onValueChange={
                                                            field.onChange
                                                        }
                                                        value={field.value}
                                                    >
                                                        <FormControl>
                                                            <SelectTrigger>
                                                                <SelectValue placeholder="Pilih bulan" />
                                                            </SelectTrigger>
                                                        </FormControl>
                                                        <SelectContent>
                                                            {months.map((month) => (
                                                                <SelectItem
                                                                    key={
                                                                        month.value
                                                                    }
                                                                    value={
                                                                        month.label
                                                                    }
                                                                >
                                                                    {month.label}
                                                                </SelectItem>
                                                            ))}
                                                        </SelectContent>
                                                    </Select>
                                                    <FormMessage />
                                                </FormItem>
                                            )}
                                        />

                                        <FormField
                                            control={form.control}
                                            name="tahun"
                                            render={({ field }) => (
                                                <FormItem>
                                                    <FormLabel>Tahun</FormLabel>
                                                    <FormControl>
                                                        <Input
                                                            type="text"
                                                            inputMode="numeric"
                                                            pattern="[0-9]*"
                                                            maxLength={4}
                                                            placeholder="Contoh: 2024"
                                                            {...field}
                                                            onChange={(e) => {
                                                                const value =
                                                                    e.target.value
                                                                        .replace(
                                                                            /[^0-9]/g,
                                                                            ""
                                                                        )
                                                                        .slice(
                                                                            0,
                                                                            4
                                                                        );
                                                                field.onChange(
                                                                    value
                                                                );
                                                            }}
                                                        />
                                                    </FormControl>
                                                    <FormMessage />
                                                </FormItem>
                                            )}
                                        />

                                        <div className="flex justify-end gap-2">
                                            <Button
                                                type="button"
                                                variant="outline"
                                                onClick={() => setOpen(false)}
                                            >
                                                Batal
                                            </Button>
                                            <Button type="submit">Simpan</Button>
                                        </div>
                                    </form>
                                </Form>
                            </DialogContent>
                        </Dialog>
                    )}
                </div>

                {/* Tabel Data */}
                <GenericTable
                    data={datas}
                    columns={columns}
                    onRowClick={handleRowClick}
                    pageSize={10}
                />

                <div className="mt-4 text-sm text-gray-500">
                    Total {datas.length} laporan bulanan
                </div>

                {/* Dialog untuk Edit Laporan */}
                <Dialog open={showEditModal} onOpenChange={setShowEditModal}>
                    <DialogContent>
                        <DialogHeader>
                            <DialogTitle>Edit Laporan Bulanan</DialogTitle>
                            <DialogDescription>
                                Edit form berikut untuk mengubah laporan
                            </DialogDescription>
                        </DialogHeader>

                        <Form {...formEdit}>
                            <form
                                onSubmit={formEdit.handleSubmit(onEditSubmit)}
                                className="space-y-6"
                            >
                                <FormField
                                    control={formEdit.control}
                                    name="bulan"
                                    render={({ field }) => (
                                        <FormItem>
                                            <FormLabel>Bulan</FormLabel>
                                            <Select
                                                onValueChange={field.onChange}
                                                value={field.value}
                                            >
                                                <FormControl>
                                                    <SelectTrigger>
                                                        <SelectValue placeholder="Pilih bulan" />
                                                    </SelectTrigger>
                                                </FormControl>
                                                <SelectContent>
                                                    {months.map((month) => (
                                                        <SelectItem
                                                            key={month.value}
                                                            value={month.label}
                                                        >
                                                            {month.label}
                                                        </SelectItem>
                                                    ))}
                                                </SelectContent>
                                            </Select>
                                            <FormMessage />
                                        </FormItem>
                                    )}
                                />

                                <FormField
                                    control={formEdit.control}
                                    name="tahun"
                                    render={({ field }) => (
                                        <FormItem>
                                            <FormLabel>Tahun</FormLabel>
                                            <FormControl>
                                                <Input
                                                    type="text"
                                                    inputMode="numeric"
                                                    pattern="[0-9]*"
                                                    maxLength={4}
                                                    placeholder="Contoh: 2024"
                                                    {...field}
                                                    onChange={(e) => {
                                                        const value =
                                                            e.target.value
                                                                .replace(
                                                                    /[^0-9]/g,
                                                                    ""
                                                                )
                                                                .slice(0, 4);
                                                        field.onChange(value);
                                                    }}
                                                />
                                            </FormControl>
                                            <FormMessage />
                                        </FormItem>
                                    )}
                                />

                                <div className="flex justify-end gap-2">
                                    <Button
                                        type="button"
                                        variant="outline"
                                        onClick={() => setShowEditModal(false)}
                                    >
                                        Batal
                                    </Button>
                                    <Button type="submit">Simpan</Button>
                                </div>
                            </form>
                        </Form>
                    </DialogContent>
                </Dialog>
            </div>
        </AuthenticatedLayout>
    );
};

export default LaporanBulanan;
