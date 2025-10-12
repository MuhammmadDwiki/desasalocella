import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import * as z from 'zod';
import { usePage, router } from '@inertiajs/react';
import {
    Form, FormControl, FormField, FormItem, FormLabel, FormMessage
} from '@/components/ui/form';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import {
    Select, SelectContent, SelectItem, SelectTrigger, SelectValue
} from '@/components/ui/select';
import { Dialog, DialogContent, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { useState } from 'react';

// Schema validasi
const formSchema = z.object({
    id_rekap: z.string(),
    id_rt: z.string().min(1, "RT harus dipilih"),
    jumlah_kk: z.coerce.number().min(0, "Minimal 0"),
    jumlah_penduduk_akhir: z.coerce.number().min(0, "Minimal 0"),
});

export default function CreateRekapitulasiRTForm({ laporanId, rtList = [], onClose = () => {} }) {
    const { auth } = usePage().props;

    // Filter RT untuk moderator
    const availableRT = auth.user.role === 'super_admin'
        ? rtList
        : rtList.filter(rt => rt.id_rt === auth.user.id_rt);

    const form = useForm({
        resolver: zodResolver(formSchema),
        defaultValues: {
            id_rekap: laporanId,
            id_rt: '',
            jumlah_kk: 0,
            jumlah_penduduk_akhir: 0,
        },
    });

    const onSubmit = (data) => {
        router.post(route('rekapitulasi-rt.store'), data, {
            onSuccess: () => {
                form.reset();
                onClose();
            },
            onError: (errors) => {
                Object.keys(errors).forEach((key) => {
                    form.setError(key, { message: errors[key] });
                });
            },
        });
    };

    return (
        <Dialog open={true} onOpenChange={onClose}>
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Tambah Data RT</DialogTitle>
                </DialogHeader>

                <Form {...form}>
                    <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-4">
                        {/* Hidden field */}
                        <input type="hidden" {...form.register('id_rekap')} />

                        {/* RT */}
                        <FormField
                            control={form.control}
                            name="id_rt"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>RT</FormLabel>
                                    <Select onValueChange={field.onChange} value={field.value}>
                                        <FormControl>
                                            <SelectTrigger>
                                                <SelectValue placeholder="Pilih RT" />
                                            </SelectTrigger>
                                        </FormControl>
                                        <SelectContent>
                                            {availableRT.map(rt => (
                                                <SelectItem key={rt.id_rt} value={rt.id_rt}>
                                                    RT {rt.nomor_rt} - {rt.nama_rt}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />

                        {/* Jumlah KK */}
                        <FormField
                            control={form.control}
                            name="jumlah_kk"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Jumlah KK</FormLabel>
                                    <FormControl>
                                        <Input type="number" min="0" {...field} />
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />

                        {/* Jumlah Penduduk Akhir */}
                        <FormField
                            control={form.control}
                            name="jumlah_penduduk_akhir"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Jumlah Penduduk Akhir</FormLabel>
                                    <FormControl>
                                        <Input type="number" min="0" {...field} />
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />

                        <div className="flex justify-end gap-2">
                            <Button type="button" variant="outline" onClick={onClose}>Batal</Button>
                            <Button type="submit">Simpan</Button>
                        </div>
                    </form>
                </Form>
            </DialogContent>
        </Dialog>
    );
}