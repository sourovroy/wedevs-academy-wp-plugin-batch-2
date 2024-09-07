import { useEffect, useState } from 'react';

function PostView() {
	const [postData, setPostData] = useState({});

	const onSubmit = (event) => {
		event.preventDefault();

		let formData = new FormData(event.target);

		formData.append('action', 'academy_settings_post_view');

		fetch(
			academySettings.ajaxUrl,
			{
				method: 'POST',
				body: formData
			}
		).then((response) => {
			return response.json();
		}).then((response) => {
			console.log(response);
		});
	};

	// Get settings data when component load.
	useEffect(() => {
		fetch(
			academySettings.ajaxUrl + "?action=academy_settings_get_post_view"
		).then((response) => {
			return response.json();
		}).then((response) => {
			if ( response.success ) {
				setPostData(response.data);
			}
		});
	}, []);

	const onCheckboxChange = (event) => {
		setPostData({...postData,
			[event.target.name]: event.target.checked
		});
	};

	return (
		<div>
			<form onSubmit={onSubmit}>
				<table className="form-table">
					<tbody>
						<tr>
							<th>Heading</th>
							<td><input type="text" className="regular-text" name="heading" defaultValue={postData.heading ? postData.heading : ''} /></td>
						</tr>
						<tr>
							<th>Show/Hide</th>
							<td>
								<label>
									<input type="checkbox" className="regular-text" name="show" onChange={onCheckboxChange} checked={postData.show ? true : false} />
									Show
								</label>
							</td>
						</tr>
						<tr>
							<th></th>
							<td>
								<button type="submit" className="components-button is-secondary">Submit</button>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	);
}

export default PostView;
