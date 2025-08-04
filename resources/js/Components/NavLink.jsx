import react from "react";
import {
    MdOutlineSpaceDashboard,
    MdOutlineAccountCircle,
    MdList,
    MdWorkOutline,
} from "react-icons/md";
import { usePage } from "@inertiajs/react";
const links = [
    {
        name: "dashboard",
        path: "/dashboard",
        icon: <MdOutlineSpaceDashboard className="text-xl" />,
    },
    {
        name: "Akun staff",
        path: "/user-account",
        icon: <MdOutlineAccountCircle className="text-xl" />,
    },
    {
        name: "Kelola RT",
        path: "/manage-rt",
        icon: <MdOutlineAccountCircle className="text-xl" />,
    },
    {
        name: "data penduduk",
        path: "/data-pdn",
        icon: <MdList className="text-xl" />,
    },
    {
        name: "kegiatan",
        path: "/kegiatan",
        icon: <MdWorkOutline className="text-xl" />,
    },
];
export default function NavLink({ containerStyles, childStyles }) {
    //   const pathname = usePathname();
    const { url } = usePage();
    const currentPath = url;

    return (
        <>
            <ul className={containerStyles}>
                {links.map((link, index) => {
                    let isActive = false;
                    if (currentPath == link.path) {
                        isActive = true;
                    }
                    const charLength = link.name.length;
                    return (
                        <a
                            href={link.path}
                            key={index}
                            className={`relative text-lg uppercase `}
                        >
                            {/* <span className="relative z-10">{link.name}</span> */}
                            <div
                                className={
                                    childStyles +
                                    (isActive ? " bg-neutral-300" : "")
                                }
                            >
                                <span>{link.icon}</span>
                                <span>{link.name}</span>
                            </div>
                        </a>
                    );
                })}
            </ul>
        </>
    );
}
