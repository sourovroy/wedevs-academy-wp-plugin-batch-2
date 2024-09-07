import { Outlet, Link } from "react-router-dom";
import { Panel, PanelBody } from '@wordpress/components';

function App() {
	return (
		<div>
			<h1>Hello Settings</h1>
			<ul>
				<li><Link to="/">Post View</Link></li>
				<li><Link to="qr-code">QR Code</Link></li>
			</ul>

			<Panel>
				<PanelBody>
					<Outlet />
				</PanelBody>
			</Panel>
		</div>
	);
}

export default App;
