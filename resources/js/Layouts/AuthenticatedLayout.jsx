import ApplicationLogo from "@/Components/ApplicationLogo";
import Dropdown from "@/Components/Dropdown";
import Header from "@/Components/Header";
import MainNav from "@/Components/MainNav";
import NavLink from "@/Components/NavLink";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink";
import { Link, usePage } from "@inertiajs/react";
import { useState } from "react";

export default function AuthenticatedLayout({
    headerName,
    children,
    routeUser,
}) {
    const user = usePage().props.auth.user;

    const [showingNavigationDropdown, setShowingNavigationDropdown] =
        useState(false);

    return (
        <div className="flex h-screen overflow-hidden">
            <div className="hidden xl:flex w-64 h-full z-99 ">
                <MainNav />
            </div>
            <div className="flex-1 ms-2 flex flex-col min-h-0 overflow-hidden">
                <Header headerName={headerName} />
                <div className="flex-1 overflow-auto ">
                    <section className="container mx-auto p-4">
                        <div>{children}</div>
                    </section>
                </div>
                
            </div>
        </div>

    );
}
