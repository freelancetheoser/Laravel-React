export default function BackButton({ className = '', disabled, children, ...props }) {
    return (
        <button
            {...props}
            className={
                `flex justify-center space-x-2 text-white bg-white hover:bg-gradient-to-br focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-md text-center hover:bg-[#005555] ${
                    disabled && 'opacity-25'
                } ` + className
            }
            disabled={disabled}
        >
            {children}
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#005555" className="bi bi-arrow-left-circle-fill hover:fill-white" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
            </svg>
        </button>
    );
}
