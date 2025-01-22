document.addEventListener('DOMContentLoaded', () => {
    const partnerships = [
        { id: 1, name: 'University of XYZ', country: 'USA', type: 'Student Exchange', status: 'Active' },
        { id: 2, name: 'ABC Institute of Technology', country: 'Germany', type: 'Research Collaboration', status: 'Pending' },
        { id: 3, name: 'Global Education Network', country: 'Multiple', type: 'Joint Program', status: 'Active' },
    ];

    const partnershipsList = document.querySelector('.partnerships-list');

    function renderPartnerships() {
        partnershipsList.innerHTML = '';
        partnerships.forEach(partnership => {
            const partnershipElement = document.createElement('div');
            partnershipElement.classList.add('partnership-item');
            partnershipElement.innerHTML = `
                <h3>${partnership.name}</h3>
                <p>Country: ${partnership.country}</p>
                <p>Type: ${partnership.type}</p>
                <p>Status: ${partnership.status}</p>
                <button class="edit-btn" data-id="${partnership.id}">Edit</button>
                <button class="delete-btn" data-id="${partnership.id}">Delete</button>
            `;
            partnershipsList.appendChild(partnershipElement);
        });
    }

    renderPartnerships();

    document.getElementById('addPartnershipBtn').addEventListener('click', () => {
        // In a real application, this would open a form to add a new partnership
        alert('Add New Partnership form would appear here.');
    });

    partnershipsList.addEventListener('click', (e) => {
        if (e.target.classList.contains('edit-btn')) {
            const id = e.target.getAttribute('data-id');
            alert(`Edit partnership with ID: ${id}`);
        } else if (e.target.classList.contains('delete-btn')) {
            const id = e.target.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this partnership?')) {
                // In a real application, this would send a request to the server
                alert(`Partnership with ID: ${id} deleted.`);
                partnerships = partnerships.filter(p => p.id !== parseInt(id));
                renderPartnerships();
            }
        }
    });
});
