import { useEffect, useState } from 'react';

type PdfModule = typeof import('react-pdf');

/**
 * Load react-pdf (pdfjs-dist) hanya di client (browser).
 *
 * pdfjs-dist memakai DOM API seperti `DOMMatrix` yang tidak ada di Node.js,
 * sehingga import statis di top-level akan merusak Inertia SSR warmup
 * (`DOMMatrix is not defined`) saat `npm run dev`.
 * Dengan dynamic import di dalam useEffect, modul tidak pernah dievaluasi di server.
 */
export function usePdfModule() {
    const [mod, setMod] = useState<PdfModule | null>(null);

    useEffect(() => {
        let cancelled = false;

        import('react-pdf')
            .then((m) => {
                m.pdfjs.GlobalWorkerOptions.workerSrc = new URL(
                    'pdfjs-dist/build/pdf.worker.min.mjs',
                    import.meta.url,
                ).toString();
                if (!cancelled) {
                    setMod(m);
                }
            })
            .catch((err) => {
                console.error('Gagal memuat react-pdf:', err);
            });

        return () => {
            cancelled = true;
        };
    }, []);

    return mod;
}
