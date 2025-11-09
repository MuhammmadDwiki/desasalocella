import React from 'react';
import { AiOutlineWarning } from 'react-icons/ai'; 

const CheckDataWarning = () => {
  return (
    <div 
      // Background: bg-amber-50 (kuning muda)
      // Border: border border-amber-300 (garis tepi kuning sedang)
      // Teks: text-amber-700 (teks kuning tua)
      // Padding, Margin, Bentuk: p-3 mb-4 rounded-md 
      // Layout: flex items-center text-sm
      className="bg-amber-50 border border-amber-300 text-amber-700 p-3 mb-4 rounded-md flex items-center text-sm"
    >
      {/* Ikon: mr-3 (margin kanan), text-xl (ukuran besar) */}
      <AiOutlineWarning className="mr-3 text-xl" />
      
      <p className="m-0">
        <span className="font-bold">Perhatian Penting!</span> Sebelum menambahkan data baru, mohon selalu{' '}
        <span className="font-semibold">cek kembali data yang sudah ada</span> untuk menghindari adanya{' '}
        <span className="font-semibold">duplikasi</span>
      </p>
    </div>
  );
};

export default CheckDataWarning;