import React, { useState, useEffect } from "react";
import {
    MdOutlineSpaceDashboard,
    MdOutlineAccountCircle,
    MdList,
    MdWorkOutline,
} from "react-icons/md";
import { LiaPeopleCarrySolid } from "react-icons/lia";
import { usePage } from "@inertiajs/react";
import { FaAngleDown , FaRegHandshake } from "react-icons/fa";
import  { MdOutlineNewspaper, MdOutlineFamilyRestroom   } from 'react-icons/md';
import { VscOrganization } from "react-icons/vsc";
import { HiOutlineUserGroup } from "react-icons/hi2";
import Can from '@/components/Can'


const allLinks = [
    {
        name: "dashboard",
        path: "/dashboard",
        icon: <MdOutlineSpaceDashboard className="text-xl" />,
    },
    {
        name: "Akun Staff",
        path: "/user-account",
        icon: <HiOutlineUserGroup className="text-xl" />,
        permission: "manage.users",
    },
    {
        name: "Kelola RT",
        path: "/manage-rt",
        icon: <MdOutlineAccountCircle className="text-xl" />,
        permission: "manage.rt",
    },
    {
        name: "Rekapitulasi",
        icon: <MdList className="text-xl" />,
        permission: "view.laporan",
        subMenu: [
            {
                name: "Laporan Bulanan",
                path: "/laporan-bulanan",
                permission: "view.laporan",
            },
            {
                name: "Agama",
                path: "/agama",
                permission: "view.agama",
            },
        ],
    },
    {
        name: "Kegiatan",
        path: "/kegiatan",
        icon: <MdWorkOutline className="text-xl" />,
        permission: "view.kegiatan",
    },
    {
        name: "Karang Taruna",
        path: "/karang-taruna",
        icon: <LiaPeopleCarrySolid className='text-xl'/>,
        permission: "view.karang_taruna",
    },
     {
        name: "Berita",
        path: "/Berita",
        icon: <MdOutlineNewspaper  className='text-xl'/>,
        permission: "view.berita",
    },
    {
       name: "Perangkat Desa",
       path: "/perangkat-desa",
       icon: <VscOrganization  className='text-xl'/>,
       permission: "view.perangkat_desa",
    },
    {
       name: "BPD",
       path: "/badan-permusyawaratan-desa",
       icon: <FaRegHandshake   className='text-xl'/>,
       permission: "view.badan_permusyawaratan_desa",
    },
    {
       name: "PKK",
       path: "/pemberdayaan-kesejahteraan-keluarga",
       icon: <MdOutlineFamilyRestroom   className='text-xl'/>,
       permission: "view.pemberdayaan_kesejahteraan_keluarga",
    },
];

export default function NavLink({ containerStyles, childStyles }) {
    const { url } = usePage();
    const currentPath = url;
    const [hoveredMenu, setHoveredMenu] = useState(null);
    const [openSubMenu, setOpenSubMenu] = useState(null);

    useEffect(() => {
        allLinks.forEach((link, index) => {
            if (link.subMenu) {
                const isActiveSub = link.subMenu.some(
                    (sub) => currentPath.startsWith(sub.path)
                );
                if (isActiveSub) {
                    setOpenSubMenu(index);
                }
            }
        });
    }, [currentPath]);

    const renderLink = (link, index) => {
        const isActive = currentPath === link.path;
        const hasSubMenu = link.subMenu && link.subMenu.length > 0;
        const isSubMenuActive = link.subMenu?.some(
            (sub) => currentPath.startsWith(sub.path)
        );
        const isSubMenuOpen = hoveredMenu === index || openSubMenu === index;

        const linkContent = (
            <li
                className="relative transition-all cursor-pointer duration-700 ease-in-out"
                key={index}
                onMouseEnter={() => setHoveredMenu(index)}
                onMouseLeave={() => setHoveredMenu(null)}
                onClick={() => setHoveredMenu(index)}
            >
                <a
                    href={hasSubMenu ? "#" : link.path}
                    className={`relative text-lg uppercase`}
                    onClick={(e) => {
                        if (hasSubMenu) {
                            e.preventDefault();
                            setOpenSubMenu(
                                openSubMenu === index ? null : index
                            );
                        }
                    }}
                >
                    <div
                        className={
                            childStyles +
                            (isActive || isSubMenuActive
                                ? " bg-red-700"
                                : "") +
                            (hasSubMenu
                                ? " group-hover:bg-red-700"
                                : "")
                        }
                    >
                        <span>{link.icon}</span>
                        <span>{link.name}</span>
                        {hasSubMenu && (
                            <span className="ml-2">
                                <FaAngleDown />
                            </span>
                        )}
                    </div>
                </a>

                {hasSubMenu && isSubMenuOpen && (
                    <ul className="inline-block left-0 mt-2 w-full transition-all duration-800 ease-in-out">
                        {link.subMenu.map((subItem, subIndex) => (
                            <Can key={subIndex} permission={subItem.permission}>
                                <li
                                    className={
                                        "hover:bg-red-700 ms-2 px-4 py-3 mt-1 rounded-md " +
                                        (currentPath.startsWith(subItem.path) ? " bg-red-700" : "")
                                    }
                                >
                                    <a
                                        href={subItem.path}
                                        className="block text-lg text-white"
                                    >
                                        {subItem.name}
                                    </a>
                                </li>
                            </Can>
                        ))}
                    </ul>
                )}
            </li>
        );

        // Jika link butuh permission, wrap dengan Can component
        if (link.permission) {
            return (
                <Can key={index} permission={link.permission}>
                    {linkContent}
                </Can>
            );
        }

        return linkContent;
    };

    return (
        <ul className={containerStyles}>
            {allLinks.map((link, index) => renderLink(link, index))}
        </ul>
    );
}