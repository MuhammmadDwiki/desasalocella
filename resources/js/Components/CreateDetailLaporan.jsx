import React, { useEffect, useState } from "react";
import { useForm as useReactHookForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { router, usePage } from "@inertiajs/react";
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
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { Plus } from "lucide-react";
import Swal from "sweetalert2";

// Kelompok umur sesuai standar yang biasa digunakan
const kelompokUmur = [
    { value: "0-5", label: "0-5 Tahun" },
    { value: "6-12", label: "6-12 Tahun" },
    { value: "13-17", label: "13-17 Tahun" },
    { value: "18-25", label: "18-25 Tahun" },
    { value: "26-35", label: "26-35 Tahun" },
    { value: "36-45", label: "36-45 Tahun" },
    { value: "46-55", label: "46-55 Tahun" },
    { value: "56-65", label: "56-65 Tahun" },
    { value: "65+", label: "65+ Tahun" },
];

const formSchema = z.object({
    id_rt: z.string().min(1, "RT harus dipilih"),
    kelompok_umur: z.string().min(1, "Kelompok umur harus dipilih"),
    jumlah_kk: z.number().min(0, "Jumlah KK tidak boleh negatif"),
    jumlah_laki_laki_awal: z.number().min(0, "Jumlah laki-laki awal tidak boleh negatif"),
    jumlah_perempuan_awal: z.number().min(0, "Jumlah perempuan awal tidak boleh negatif"),
    jumlah_laki_laki_akhir: z.number().min(0, "Jumlah laki-laki akhir tidak boleh negatif"),
    jumlah_perempuan_akhir: z.number().min(0, "Jumlah perempuan akhir tidak boleh negatif"),
    jumlah_laki_laki_pindah: z.number().min(0, "Jumlah laki-laki pindah tidak boleh negatif"),
    jumlah_perempuan_pindah: z.number().min(0, "Jumlah perempuan pindah tidak boleh negatif"),
    jumlah_laki_laki_datang: z.number().min(0, "Jumlah laki-laki datang tidak boleh negatif"),
    jumlah_perempuan_datang: z.number().min(0, "Jumlah perempuan datang tidak boleh negatif"),
});

const CreateDetailLaporan = ({ idRekap,idRekapRt, rtList, existingData = [] }) => {
    const [open, setOpen] = useState(false);
    const { auth } = usePage().props;
    const [usedAgeGroups, setUsedAgeGroups] = useState([]);
    const [loadingAgeGroups, setLoadingAgeGroups] = useState(false);
 
    const getUsedAge = async() =>{

            try {
            const response = await axios.get(
                route("detail-laporan.getUsedAgeGroups", {id_rekap_rt : idRekapRt})
            );
            const data = await response.data;
            // console.log(data)

            setUsedAgeGroups(data);
        } catch (error) {
            console.error("Error fetching used age groups:", error);
        } finally {
            setLoadingAgeGroups(false);
        }
    }
    const form = useReactHookForm({
        resolver: zodResolver(formSchema),
        defaultValues: {
            id_rt: auth.user.role === "moderator" ? auth.user.id_rt : "",
            kelompok_umur: "",
            jumlah_kk: 0,
            jumlah_laki_laki_awal: 0,
            jumlah_perempuan_awal: 0,
            jumlah_laki_laki_akhir: 0,
            jumlah_perempuan_akhir: 0,
            jumlah_laki_laki_pindah: 0,
            jumlah_perempuan_pindah: 0,
            jumlah_laki_laki_datang: 0,
            jumlah_perempuan_datang: 0,
        },
    });
    const availableAgeGroups = kelompokUmur.filter(
            (group) => !usedAgeGroups.includes(group.value)
        );
    const handleRTChange = async (rtId) => {
         // Reset pilihan kelompok umur
         console.log(rtId)
        form.setValue("id_rt", rtId); // <-- jangan pakai object
        form.setValue("kelompok_umur", "");
        if (!rtId) {
            setUsedAgeGroups([]);
            return;
        }

        setLoadingAgeGroups(true);
        try {
            const response = await axios.get(
                route("detail-laporan.getUsedAgeGroups", {
                    id_rekap_rt: idRekapRt,
                 
                })
            );
            // console.log(response)
            const data = await response.data;

            setUsedAgeGroups(data);
        } catch (error) {
            console.error("Error fetching used age groups:", error);
        } finally {
            setLoadingAgeGroups(false);
        }
    };

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
        // Cek apakah RT sudah ada dalam laporan ini
        const rtExists = existingData.some(item => item.id_rt === data.id_rt);
        
        // if (rtExists) {
        //     Toast.fire({
        //         icon: "error",
        //         title: "RT ini sudah ada dalam laporan!",
        //     });
        //     return;
        // }
        // return console.log(data, idRekap);

        router.post(route("detailLaporan.store"), {
            id_rekap: idRekap,
            ...data,
        }, {
            onSuccess: () => {
                Toast.fire({
                    icon: "success",
                    title: "Detail laporan berhasil ditambahkan",
                });
                form.reset();
                setOpen(false);
            },
            onError: (errors) => {
                console.error("Validation errors:", errors);
                Toast.fire({
                    icon: "error",
                    title: "Gagal menambahkan detail laporan",
                });
            },
        });
    };

    // Filter RT list berdasarkan role user dan data yang sudah ada
    const getAvailableRtList = () => {
        let availableRt = rtList || [];
        
        // Jika moderator, hanya tampilkan RT miliknya
        if (auth.user.role === "moderator") {
            availableRt = availableRt.filter(rt => rt.id_rt === auth.user.id_rt);
        }
        
        // Filter RT yang belum ada dalam laporan ini
        // availableRt = availableRt.filter(rt => 
        //     !existingData.some(existing => existing.id_rt === rt.id_rt)
        // );
                
        return availableRt;
    };

    const availableRtList = getAvailableRtList();

    // console.log(form.getValues())

    return (
        <Dialog open={open} onOpenChange={setOpen}>
            <DialogTrigger asChild>
                <Button variant="default" className="flex items-center gap-2" onClick={() => {getUsedAge()}}>
                    <Plus className="h-4 w-4" />
                    Buat
                </Button>
            </DialogTrigger>
            <DialogContent className="max-w-4xl max-h-[90vh] overflow-y-auto">
                <DialogHeader>
                    <DialogTitle>Tambah Detail Laporan RT</DialogTitle>
                    <DialogDescription>
                        Isi form berikut untuk menambahkan detail laporan RT
                    </DialogDescription>
                </DialogHeader>

                <Form {...form}>
                    <form
                        onSubmit={form.handleSubmit(onSubmit)}
                        className="space-y-4"
                    >
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {/* RT Selection */}
                            <FormField
                                control={form.control}
                                name="id_rt"
                                render={({ field }) => (
                                    <FormItem>
                                        <FormLabel>RT</FormLabel>
                                        <Select
                                            onValueChange={(value)=>{
                                                // console.log(value)
                                                field.onChange(value); // Update form state
                                                handleRTChange(value);
                                            }
                                                
                                            }
                                            value={field.value}
                                            disabled={auth.user.role === "moderator"}
                                        >
                                            <FormControl>
                                                <SelectTrigger>
                                                    <SelectValue placeholder="Pilih RT" />
                                                </SelectTrigger>
                                            </FormControl>
                                            <SelectContent>
                                                {availableRtList.map((rt) => (
                                                    <SelectItem
                                                        key={rt.id_rt}
                                                        value={String(rt.id_rt)}

                                                    >
                                                        RT {rt.nomor_rt} - {rt.nama_rt}
                                                    </SelectItem>
                                                ))}
                                            </SelectContent>
                                        </Select>
                                        <FormMessage />
                                    </FormItem>
                                )}
                            />

                            {/* Kelompok Umur */}
                            <FormField
                                control={form.control}
                                name="kelompok_umur"
                                render={({ field }) => (
                                    <FormItem>
                                        <FormLabel>Kelompok Umur</FormLabel>
                                        <Select
                                            onValueChange={field.onChange}
                                            value={field.value}
                                        >
                                            <FormControl>
                                                <SelectTrigger>
                                                    <SelectValue placeholder="Pilih kelompok umur" />
                                                </SelectTrigger>
                                            </FormControl>
                                            <SelectContent>
                                                {availableAgeGroups.map((umur) => (
                                                    <SelectItem
                                                        key={umur.value}
                                                        value={umur.value}
                                                    >
                                                        {umur.label}
                                                    </SelectItem>
                                                ))}
                                            </SelectContent>
                                        </Select>
                                        <FormMessage />
                                    </FormItem>
                                )}
                            />
                        </div>

                        {/* Jumlah KK */}
                        <FormField
                            control={form.control}
                            name="jumlah_kk"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Jumlah Kepala Keluarga (KK)</FormLabel>
                                    <FormControl>
                                        <Input
                                            type="number"
                                            min="0"
                                            placeholder="0"
                                            {...field}
                                            onChange={(e) => field.onChange(parseInt(e.target.value) || 0)}
                                        />
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />

                        {/* Data Awal */}
                        <div className="space-y-4">
                            <h3 className="text-lg font-medium text-gray-900">Data Awal Bulan</h3>
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <FormField
                                    control={form.control}
                                    name="jumlah_laki_laki_awal"
                                    render={({ field }) => (
                                        <FormItem>
                                            <FormLabel>Jumlah Laki-laki Awal</FormLabel>
                                            <FormControl>
                                                <Input
                                                    type="number"
                                                    min="0"
                                                    placeholder="0"
                                                    {...field}
                                                    onChange={(e) => field.onChange(parseInt(e.target.value) || 0)}
                                                />
                                            </FormControl>
                                            <FormMessage />
                                        </FormItem>
                                    )}
                                />

                                <FormField
                                    control={form.control}
                                    name="jumlah_perempuan_awal"
                                    render={({ field }) => (
                                        <FormItem>
                                            <FormLabel>Jumlah Perempuan Awal</FormLabel>
                                            <FormControl>
                                                <Input
                                                    type="number"
                                                    min="0"
                                                    placeholder="0"
                                                    {...field}
                                                    onChange={(e) => field.onChange(parseInt(e.target.value) || 0)}
                                                />
                                            </FormControl>
                                            <FormMessage />
                                        </FormItem>
                                    )}
                                />
                            </div>
                        </div>
 {/* Data Akhir */}
                        <div className="space-y-4">
                            <h3 className="text-lg font-medium text-gray-900">Data Akhir Bulan</h3>
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <FormField
                                    control={form.control}
                                    name="jumlah_laki_laki_akhir"
                                    render={({ field }) => (
                                        <FormItem>
                                            <FormLabel>Jumlah Laki-laki Akhir</FormLabel>
                                            <FormControl>
                                                <Input
                                                    type="number"
                                                    min="0"
                                                    placeholder="0"
                                                    {...field}
                                                    onChange={(e) => field.onChange(parseInt(e.target.value) || 0)}
                                                />
                                            </FormControl>
                                            <FormMessage />
                                        </FormItem>
                                    )}
                                />

                                <FormField
                                    control={form.control}
                                    name="jumlah_perempuan_akhir"
                                    render={({ field }) => (
                                        <FormItem>
                                            <FormLabel>Jumlah Perempuan Akhir</FormLabel>
                                            <FormControl>
                                                <Input
                                                    type="number"
                                                    min="0"
                                                    placeholder="0"
                                                    {...field}
                                                    onChange={(e) => field.onChange(parseInt(e.target.value) || 0)}
                                                />
                                            </FormControl>
                                            <FormMessage />
                                        </FormItem>
                                    )}
                                />
                            </div>
                        </div>
                        {/* Data Mutasi */}
                        <div className="space-y-4">
                            <h3 className="text-lg font-medium text-gray-900">Data Mutasi Penduduk</h3>
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div className="space-y-3">
                                    <h4 className="text-md font-medium text-gray-700">Penduduk Pindah</h4>
                                    <FormField
                                        control={form.control}
                                        name="jumlah_laki_laki_pindah"
                                        render={({ field }) => (
                                            <FormItem>
                                                <FormLabel>Laki-laki Pindah</FormLabel>
                                                <FormControl>
                                                    <Input
                                                        type="number"
                                                        min="0"
                                                        placeholder="0"
                                                        {...field}
                                                        onChange={(e) => field.onChange(parseInt(e.target.value) || 0)}
                                                    />
                                                </FormControl>
                                                <FormMessage />
                                            </FormItem>
                                        )}
                                    />

                                    <FormField
                                        control={form.control}
                                        name="jumlah_perempuan_pindah"
                                        render={({ field }) => (
                                            <FormItem>
                                                <FormLabel>Perempuan Pindah</FormLabel>
                                                <FormControl>
                                                    <Input
                                                        type="number"
                                                        min="0"
                                                        placeholder="0"
                                                        {...field}
                                                        onChange={(e) => field.onChange(parseInt(e.target.value) || 0)}
                                                    />
                                                </FormControl>
                                                <FormMessage />
                                            </FormItem>
                                        )}
                                    />
                                </div>

                                <div className="space-y-3">
                                    <h4 className="text-md font-medium text-gray-700">Penduduk Datang</h4>
                                    <FormField
                                        control={form.control}
                                        name="jumlah_laki_laki_datang"
                                        render={({ field }) => (
                                            <FormItem>
                                                <FormLabel>Laki-laki Datang</FormLabel>
                                                <FormControl>
                                                    <Input
                                                        type="number"
                                                        min="0"
                                                        placeholder="0"
                                                        {...field}
                                                        onChange={(e) => field.onChange(parseInt(e.target.value) || 0)}
                                                    />
                                                </FormControl>
                                                <FormMessage />
                                            </FormItem>
                                        )}
                                    />

                                    <FormField
                                        control={form.control}
                                        name="jumlah_perempuan_datang"
                                        render={({ field }) => (
                                            <FormItem>
                                                <FormLabel>Perempuan Datang</FormLabel>
                                                <FormControl>
                                                    <Input
                                                        type="number"
                                                        min="0"
                                                        placeholder="0"
                                                        {...field}
                                                        onChange={(e) => field.onChange(parseInt(e.target.value) || 0)}
                                                    />
                                                </FormControl>
                                                <FormMessage />
                                            </FormItem>
                                        )}
                                    />
                                </div>
                            </div>
                        </div>

                       

                        <div className="flex justify-end gap-2 pt-4">
                            <Button
                                type="button"
                                variant="outline"
                                onClick={() => setOpen(false)}
                            >
                                Batal
                            </Button>
                            <Button type="submit">
                                Simpan Detail
                            </Button>
                        </div>
                    </form>
                </Form>
            </DialogContent>
        </Dialog>
    );
};

export default CreateDetailLaporan;