import React, { useState } from "react";
import { useForm as userFormReactHook } from "react-hook-form";
import axios from "axios";

import {
    Head,
    router,
    useForm as useFormInertia,
    usePage,
} from "@inertiajs/react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";

import Swal from "sweetalert2";

const CreateDetailLaporan = ({ idRekap, rtList }) => {
    const [open, setOpen] = useState(false);
    const [usedAgeGroups, setUsedAgeGroups] = useState([]);
    const [loadingAgeGroups, setLoadingAgeGroups] = useState(false);

    const { data, setData, post, processing, errors, reset } = useFormInertia({
        id_rekap: idRekap,
        id_rt: "",
        kelompok_umur: "",
        jumlah_laki_laki_awal: 0,
        jumlah_perempuan_awal: 0,
        jumlah_laki_laki_akhir: 0,
        jumlah_perempuan_akhir: 0,
        jumlah_laki_laki_pindah: 0,
        jumlah_perempuan_pindah: 0,
        jumlah_laki_laki_datang: 0,
        jumlah_perempuan_datang: 0,
    });
    const kelompokUmurOptions = [
        "0-5",
        "6-12",
        "13-17",
        "18-25",
        "26-35",
        "36-45",
        "46-55",
        "56-65",
        ">65",
    ];
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
    const handleSubmit = (e) => {
        e.preventDefault();

        post(route("detailLaporan.store"), {
            onSuccess: () => {
                Toast.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: "Detail laporan berhasil ditambahkan",
                });
                setOpen(false);
                reset();
                setUsedAgeGroups([]);
            },
            onError: (errors) => {
                Toast.fire({
                    icon: "error",
                    title: "Error",
                    text: "Detail laporan gagal ditambahkan",
                });
            },
        });
    };
    const handleCancel = () => {
        setOpen(false);
        setUsedAgeGroups([]);
    };
    const availableAgeGroups = kelompokUmurOptions.filter(
        (group) => !usedAgeGroups.includes(group)
    );
    const handleRTChange = async (rtId) => {
        setData("id_rt", rtId);
        setData("kelompok_umur", ""); // Reset pilihan kelompok umur

        if (!rtId) {
            setUsedAgeGroups([]);
            return;
        }

        setLoadingAgeGroups(true);
        try {
            const response = await axios.get(
                route("detail-laporan.getUsedAgeGroups", {
                    idRekap: idRekap,
                    idRT: rtId,
                })
            );
            const data = await response.data;

            setUsedAgeGroups(data);
        } catch (error) {
            console.error("Error fetching used age groups:", error);
        } finally {
            setLoadingAgeGroups(false);
        }
    };
    return (
        <Dialog open={open} onOpenChange={setOpen}>
            <DialogTrigger asChild>
                <Button variant="default">Tambah Detail Laporan</Button>
            </DialogTrigger>
            <DialogContent className="max-w-2xl max-h-[90vh] overflow-y-auto">
                <DialogHeader>
                    <DialogTitle>Tambah Detail Laporan</DialogTitle>
                </DialogHeader>

                <form onSubmit={handleSubmit} className="space-y-4">
                    {/* Input RT */}
                    <div className="grid gap-2">
                        <Label htmlFor="id_rt">RT</Label>
                        <Select
                            onValueChange={(value) => handleRTChange(value)}
                            // onValueChange={(value) => setData("id_rt", value)}
                            value={data.id_rt}
                        >
                            <SelectTrigger>
                                <SelectValue placeholder="Pilih RT" />
                            </SelectTrigger>
                            <SelectContent>
                                {rtList.map((rt) => (
                                    <SelectItem key={rt.id_rt} value={rt.id_rt}>
                                        RT {rt.nomor_rt}
                                    </SelectItem>
                                ))}
                            </SelectContent>
                        </Select>
                        {errors.id_rt && (
                            <p className="text-sm text-red-500">
                                {errors.id_rt}
                            </p>
                        )}
                    </div>

                    {/* Input Kelompok Umur */}
                    <div className="grid gap-2">
                        <Label htmlFor="kelompok_umur">Kelompok Umur</Label>
                        {loadingAgeGroups ? (
                            <p>Memuat kelompok umur...</p>
                        ) : (
                            <Select
                                onValueChange={(value) =>
                                    setData("kelompok_umur", value)
                                }
                                value={data.kelompok_umur}
                                disabled={
                                    !data.id_rt ||
                                    availableAgeGroups.length === 0
                                }
                            >
                                <SelectTrigger>
                                    <SelectValue
                                        placeholder={
                                            !data.id_rt
                                                ? "Pilih RT terlebih dahulu"
                                                : availableAgeGroups.length ===
                                                  0
                                                ? "Semua kelompok umur sudah terdaftar"
                                                : "Pilih kelompok umur"
                                        }
                                    />
                                </SelectTrigger>
                                <SelectContent>
                                    {availableAgeGroups.map((kelompok) => (
                                        <SelectItem
                                            key={kelompok}
                                            value={kelompok}
                                        >
                                            {kelompok} Tahun
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                        )}
                        {errors.kelompok_umur && (
                            <p className="text-sm text-red-500">
                                {errors.kelompok_umur}
                            </p>
                        )}
                        {data.id_rt && usedAgeGroups.length > 0 && (
                            <p className="text-sm text-gray-500">
                                Kelompok umur sudah terdaftar untuk RT ini:{" "}
                                {usedAgeGroups.join(", ")}
                            </p>
                        )}
                    </div>

                    {/* Section Awal Bulan */}
                    <div className="border rounded-lg p-4 space-y-4">
                        <h3 className="font-medium">Awal Bulan</h3>
                        <div className="grid grid-cols-2 gap-4">
                            <div className="grid gap-2">
                                <Label htmlFor="jumlah_laki_laki_awal">
                                    Laki-laki
                                </Label>
                                <Input
                                    id="jumlah_laki_laki_awal"
                                    type="number"
                                    min="0"
                                    value={data.jumlah_laki_laki_awal}
                                    onChange={(e) =>
                                        setData(
                                            "jumlah_laki_laki_awal",
                                            e.target.value
                                        )
                                    }
                                />
                            </div>
                            <div className="grid gap-2">
                                <Label htmlFor="jumlah_perempuan_awal">
                                    Perempuan
                                </Label>
                                <Input
                                    id="jumlah_perempuan_awal"
                                    type="number"
                                    min="0"
                                    value={data.jumlah_perempuan_awal}
                                    onChange={(e) =>
                                        setData(
                                            "jumlah_perempuan_awal",
                                            e.target.value
                                        )
                                    }
                                />
                            </div>
                        </div>
                    </div>

                    {/* Section Akhir Bulan */}
                    <div className="border rounded-lg p-4 space-y-4">
                        <h3 className="font-medium">Akhir Bulan</h3>
                        <div className="grid grid-cols-2 gap-4">
                            <div className="grid gap-2">
                                <Label htmlFor="jumlah_laki_laki_akhir">
                                    Laki-laki
                                </Label>
                                <Input
                                    id="jumlah_laki_laki_akhir"
                                    type="number"
                                    min="0"
                                    value={data.jumlah_laki_laki_akhir}
                                    onChange={(e) =>
                                        setData(
                                            "jumlah_laki_laki_akhir",
                                            e.target.value
                                        )
                                    }
                                />
                            </div>
                            <div className="grid gap-2">
                                <Label htmlFor="jumlah_perempuan_akhir">
                                    Perempuan
                                </Label>
                                <Input
                                    id="jumlah_perempuan_akhir"
                                    type="number"
                                    min="0"
                                    value={data.jumlah_perempuan_akhir}
                                    onChange={(e) =>
                                        setData(
                                            "jumlah_perempuan_akhir",
                                            e.target.value
                                        )
                                    }
                                />
                            </div>
                        </div>
                    </div>

                    {/* Section Pindah */}
                    <div className="border rounded-lg p-4 space-y-4">
                        <h3 className="font-medium">Pindah</h3>
                        <div className="grid grid-cols-2 gap-4">
                            <div className="grid gap-2">
                                <Label htmlFor="jumlah_laki_laki_pindah">
                                    Laki-laki
                                </Label>
                                <Input
                                    id="jumlah_laki_laki_pindah"
                                    type="number"
                                    min="0"
                                    value={data.jumlah_laki_laki_pindah}
                                    onChange={(e) =>
                                        setData(
                                            "jumlah_laki_laki_pindah",
                                            e.target.value
                                        )
                                    }
                                />
                            </div>
                            <div className="grid gap-2">
                                <Label htmlFor="jumlah_perempuan_pindah">
                                    Perempuan
                                </Label>
                                <Input
                                    id="jumlah_perempuan_pindah"
                                    type="number"
                                    min="0"
                                    value={data.jumlah_perempuan_pindah}
                                    onChange={(e) =>
                                        setData(
                                            "jumlah_perempuan_pindah",
                                            e.target.value
                                        )
                                    }
                                />
                            </div>
                        </div>
                    </div>

                    {/* Section Datang */}
                    <div className="border rounded-lg p-4 space-y-4">
                        <h3 className="font-medium">Datang</h3>
                        <div className="grid grid-cols-2 gap-4">
                            <div className="grid gap-2">
                                <Label htmlFor="jumlah_laki_laki_datang">
                                    Laki-laki
                                </Label>
                                <Input
                                    id="jumlah_laki_laki_datang"
                                    type="number"
                                    min="0"
                                    value={data.jumlah_laki_laki_datang}
                                    onChange={(e) =>
                                        setData(
                                            "jumlah_laki_laki_datang",
                                            e.target.value
                                        )
                                    }
                                />
                            </div>
                            <div className="grid gap-2">
                                <Label htmlFor="jumlah_perempuan_datang">
                                    Perempuan
                                </Label>
                                <Input
                                    id="jumlah_perempuan_datang"
                                    type="number"
                                    min="0"
                                    value={data.jumlah_perempuan_datang}
                                    onChange={(e) =>
                                        setData(
                                            "jumlah_perempuan_datang",
                                            e.target.value
                                        )
                                    }
                                />
                            </div>
                        </div>
                    </div>

                    <div className="flex justify-end gap-2 pt-4">
                        <Button
                            type="button"
                            variant="outline"
                            onClick={() => handleCancel()}
                        >
                            Batal
                        </Button>
                        <Button
                            type="submit"
                            disabled={
                                processing || !data.id_rt || !data.kelompok_umur
                            }
                        >
                            {processing ? "Menyimpan..." : "Simpan"}
                        </Button>
                    </div>
                </form>
            </DialogContent>
        </Dialog>
    );
};

export default CreateDetailLaporan;
