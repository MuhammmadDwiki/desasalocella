import ApplicationLogo from "@/Components/ApplicationLogo";
import { Link } from "@inertiajs/react";
import { MdArrowBack } from "react-icons/md";

export default function GuestLayout({ children }) {
    return (
        <div className="bg-gradient-to-tr from-emerald-900 to-teal-600 via-emerald-700 min-w-screen min-h-screen">
            <div className="flex min-h-screen flex-col items-center pt-6 sm:justify-center sm:pt-0">
                <div className="">
                    <a href="/">
                        <ApplicationLogo className="h-20 w-20 fill-current text-gray-100" />
                    </a>
                </div>
                <div className="mt-6 w-full px-2 sm:max-w-md text-white">
                    <a href="/">
                        <div className="flex items-center gap-2">
                            <MdArrowBack />
                            <p>Go to Home</p>
                        </div>
                    </a>
                </div>
                <div className="mt-3 w-full overflow-hidden bg-white  px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
                    {children}
                </div>
            </div>
        </div>
    );
}
