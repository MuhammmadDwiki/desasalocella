import react, { useState, useEffect } from "react";
import {
    MdOutlineSpaceDashboard,
    MdOutlineAccountCircle,
    MdList,
    MdWorkOutline,
} from "react-icons/md";
import { LiaPeopleCarrySolid } from "react-icons/lia";
import { usePage } from "@inertiajs/react";
import { FaAngleDown } from "react-icons/fa";
const links = [
    {
        name: "dashboard",
        path: "/dashboard",
        icon: <MdOutlineSpaceDashboard className="text-xl" />,
    },
    {
        name: "Kelola RT",
        path: "/manage-rt",
        icon: <MdOutlineAccountCircle className="text-xl" />,
    },
    {
        name: "Rekapitulasi",
        icon: <MdList className="text-xl" />,
        subMenu: [
            {
                name: "Laporan Bulanan",
                path: "/laporan-bulanan",
            },
            {
                name: "Agama",
                path: "/agama",
            },
        ],
    },
    {
        name: "kegiatan",
        path: "/kegiatan",
        icon: <MdWorkOutline className="text-xl" />,
    },
    {
        name: "karang Taruna",
        path: "/karang-taruna",
        icon: <LiaPeopleCarrySolid className='text-xl'/>,
    },
    
];
export default function NavLink({ containerStyles, childStyles }) {
    //   const pathname = usePathname();
    const { url } = usePage();
    const currentPath = url;
    const [hoveredMenu, setHoveredMenu] = useState(null);
    const [openSubMenu, setOpenSubMenu] = useState(null);
    useEffect(() => {
        links.forEach((link, index) => {
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
    return (
        <>
            <ul className={containerStyles}>
                {links.map((link, index) => {
                    const isActive = currentPath === link.path;

                    const hasSubMenu = link.subMenu && link.subMenu.length > 0;
                    const isSubMenuActive = link.subMenu?.some(
                        (sub) => currentPath.startsWith(sub.path)
                    );
                    const isSubMenuOpen =
                        hoveredMenu === index || openSubMenu === index;

                    // console.log(isSubMenuActive, currentPath);

                    const charLength = link.name.length;
                    return (
                        <li
                            className="relative transition-all cursor-pointer duration-700 ease-in-out"
                            key={index}
                            onMouseEnter={() => setHoveredMenu(index)}
                            onMouseLeave={() => setHoveredMenu(null)}
                            onClick={() => setHoveredMenu(index)}
                        >
                            <a
                                href={link?.path}
                                className={`relative text-lg uppercase `}
                                onClick={(e) => {
                                    if (hasSubMenu) {
                                        e.preventDefault();
                                        setOpenSubMenu(
                                            openSubMenu === index ? null : index
                                        );
                                    }
                                }}
                            >
                                {/* <span className="relative z-10">{link.name}</span> */}
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
                                        <span className="ml-2 ">
                                            <FaAngleDown />
                                        </span>
                                    )}
                                </div>
                            </a>
                            {hasSubMenu && isSubMenuOpen && (
                                <ul className="inline-block left-0 mt-2 w-full transition-all duration-800 ease-in-out  ">
                                    {link.subMenu.map((subItem, subIndex) => {
                                        const isActive =
                                            currentPath.startsWith(subItem.path);
                                        return (
                                            <li
                                                key={subIndex}
                                                className={
                                                    "hover:bg-red-700 ms-2 px-4 py-3 mt-1 rounded-md " +
                                                    (isActive
                                                        ? " bg-red-700"
                                                        : "")
                                                }
                                            >
                                                <a
                                                    href={subItem.path}
                                                    className="block text-lg text-white "
                                                >
                                                    {subItem.name}
                                                </a>
                                            </li>
                                        );
                                    })}
                                </ul>
                            )}
                        </li>
                    );
                })}
            </ul>
        </>
    );
}
