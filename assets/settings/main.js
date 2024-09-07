import { createRoot } from 'react-dom/client';
import { createHashRouter, RouterProvider } from "react-router-dom";

import './main.scss';

import App from './components/App';
import PostView from './components/PostView';
import QRCode from './components/QRCode';

const router = createHashRouter([
	{
		path: "/",
		element: <App />,
		children: [
			{
				path: "",
				element: <PostView />,
			},
			{
				path: "qr-code",
				element: <QRCode />,
			},
		],
	},
]);

const root = createRoot( document.getElementById('academy-settings-app') );

root.render(<RouterProvider router={router} />);
