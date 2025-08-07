import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, router, useForm as useInertiaForm } from "@inertiajs/react";
import { useForm as useReactHookForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { format } from "date-fns";
import { CalendarIcon } from "lucide-react";
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

import { Calendar } from "@/components/ui/calendar";
import { GenericTable } from "@/Components/GenericTable";
import { createColumnHelper } from "@tanstack/react-table";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";
import { useState } from "react";
import Swal from "sweetalert2";
import { Pencil, Trash2 } from "lucide-react";

const dataLaporan = [
    {
        id: 1,
        bulan: "Januari",
        tahun: 2023,
        jumlahLaporan: 5,
    },
    {
        id: 2,
        bulan: "Februari",
        tahun: 2023,
        jumlahLaporan: 3,
        status: "Dalam Proses",
    },
    {
        id: 3,
        bulan: "Maret",
        tahun: 2023,
        jumlahLaporan: 4,
    },
    {
        id: 4,
        bulan: "April",
        tahun: 2023,
        jumlahLaporan: 2,
    },
];

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
    const { post } = useInertiaForm();
    const form = useReactHookForm({
        resolver: zodResolver(formSchema),
        defaultValues: {
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
    // console.log(datas);
    const onSubmit = (data) => {
        const isDuplicate = datas.some(
            (report) =>
                report.bulan === data.bulan && report.tahun === data.tahun
        );

        if (isDuplicate) {
            Toast.fire({
                icon: "error",
                title: `Laporan untuk ${data.bulan} ${data.tahun}  sudah ada`,
            });
            return;
        }
        console.log("data yang akan dikirim:", data);
        post(
            route("laporan.store", {
                bulan: data.bulan,
                tahun: data.tahun,
            }),
            {
                onSuccess: () => {
                    Toast.fire({
                        icon: "success",
                        title: `Laporan ${data.bulan} ${data.tahun} berhasil ditambahkan`,
                    });
                    form.reset();
                    setOpen(false);
                },
                onError: (errors) => {
                    Toast.fire({
                        icon: "error",
                        title: "Gagal menambahkan laporan",
                    });
                },
            }
        );

        // form.reset();
        //             setOpen(false);
        //             Toast.fire({
        //                 title: `Laporan ${data.bulan} ${data.tahun} berhasil ditambahkan`,
        //             });
    };

    const columnHelper = createColumnHelper();
    const columns = [
        columnHelper.accessor("id_rekap", {
            header: "ID",
            cell: (info) => (
                <span className="">
                    <a
                        href={"/laporan-bulanan/" + info.getValue()}
                        className="text-blue-600 uppercase"
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
        // columnHelper.accessor("jumlahLaporan", {
        //     header: "Jumlah Laporan",
        //     cell: (info) => info.getValue(),
        // }),
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
                            // onClick={() => setShowEditModal(true)}
                        >
                            <Pencil className="h-4 w-4" />
                        </Button>
                        <Button
                            variant="destructive"
                            size="icon"
                            // onClick={(e) => {
                            //     // console.log(row.original.id_rt)
                            //     // e.stopPropagation();
                            //     // handleDelete(row.original.id);
                            //     Swal.fire({
                            //         title: "yakin ingin menghapus ini ?",
                            //         showConfirmButton: true,
                            //         showCancelButton: true,
                            //         confirmButtonText: "Ya",
                            //     }).then((result) => {
                            //         if (result.isConfirmed) {
                            //             // Swal.fire("Saved!", "", "success");
                            //             // router.delete(
                            //             //     route(
                            //             //         "rt.destroy",
                            //             //         row.original.id_rt
                            //             //     ),
                            //             //     {
                            //             //         onSuccess: () => {
                            //             //             Toast.fire({
                            //             //                 icon: "success",
                            //             //                 title: "Berhasil dihapus",
                            //             //             });
                            //             //         },
                            //             //     }
                            //             // );
                            //         }
                            //     });
                            //     // if (confirm("yakin ingin menghapus ini ?")) {
                            //     // }
                            // }}
                        >
                            <Trash2 className="h-4 w-4" />
                        </Button>
                        {/* {showEditModal && (
                                    <EditRTModal
                                        rt={row.original}
                                        // onClose={() => setShowEditModal(false)}
                                    />
                                )} */}
                    </div>
                );
            },
        }),
    ];
    const handleRowClick = (staff) => {
        // console.log(data);
        // setData(staff);
        // console.log("Staff dipilih:", data);
        // Navigasi ke halaman detail atau modal
        // router.push(`/staff/${staff.id}`);
    };

    return (
        <AuthenticatedLayout headerName="Laporan Bulanan">
            <Head title="Laporan Bulanan" />
            <div className="container mx-auto py-6">
                <div className="flex justify-between  items-center mb-6">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-800">
                            Laporan Bulanan
                        </h1>
                        <p className="text-gray-600">
                            Lihat dan kelola semua laporan bulanan RT
                        </p>
                    </div>
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
                                                            // Hanya izinkan angka dan maksimal 4 digit
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
                </div>
                <GenericTable
                    data={datas}
                    columns={columns}
                    onRowClick={handleRowClick}
                    pageSize={5}
                />
            </div>
        </AuthenticatedLayout>
    );
};

export default LaporanBulanan;
