import { useForm } from "@inertiajs/react";
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
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Switch } from "@/components/ui/switch";
import Swal from "sweetalert2";

export default function EditRTModal({ rt, onClose }) {
    const { data, setData, put, processing, errors } = useForm({
        nomor_rt: rt.nomor_rt, // Konversi ke string
        nama_rt: rt.nama_rt,
        alamat_rt: rt.alamat_rt,
        nomor_hp: String(rt.nomor_hp),
        is_active: Boolean(rt.is_active), // Konversi ke boolean
    });
    // console.log("data from modal", rt);
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
        console.log("Data yang akan dikirim:", data);

        put(route("rt.update", rt.id_rt), {
            onSuccess: () => {
                onClose()
                Toast.fire({
                    icon: "success",
                    title: "Berhasil mengubah"
                })
            },
            onError: (e) => {
                Toast.fire({
                    icon: "error",
                    title: "Gagal menyimpan",
                    text: Object.values(e).join("\n"),
                });
            },
        });
    };

    return (
        <Dialog open={true} onOpenChange={onClose}>
            <form>
                <DialogContent className="sm:max-w-[525px]">
                    <DialogHeader>
                        <DialogTitle>Edit Data RT</DialogTitle>
                        <DialogDescription>
                            Isi form berikut untuk mengubah data RT yang sudah
                            ada.
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
                                    setData("nama_rt", e.target.value)
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
                                <Label htmlFor="nomor_rt">Nomor RT</Label>
                                <Input
                                    id="nomor_rt"
                                    name="nomor_rt"
                                    value={data.nomor_rt}
                                    onChange={(e) =>
                                        setData("nomor_rt", e.target.value)
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
                                <Label htmlFor="nomor_hp">Nomor Hp</Label>
                                <Input
                                    type="number"
                                    id="nomor_hp"
                                    name="nomor_hp"
                                    value={data.nomor_hp}
                                    onChange={(e) =>
                                        setData("nomor_hp", e.target.value)
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
                            <Label htmlFor="alamat_rt">Alamat RT</Label>
                            <Input
                                id="alamat_rt"
                                name="alamat_rt"
                                value={data.alamat_rt}
                                onChange={(e) =>
                                    setData("alamat_rt", e.target.value)
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
                        <div className="flex items-center mt-2 gap-3">
                            <Label htmlFor="is_active">Status Aktif</Label>
                            <Switch
                                checked={data.is_active}
                                onCheckedChange={(e) => {
                                    setData("is_active", e);
                                }}
                            />
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
                            disabled={processing}
                            onClick={(e) => {
                                e.preventDefault();
                                handleSubmit(e);
                            }}
                        >
                            {processing ? "Menyimpan..." : "Simpan Perubahan"}
                        </Button>
                    </DialogFooter>
                </DialogContent>
            </form>
        </Dialog>
    );
}
