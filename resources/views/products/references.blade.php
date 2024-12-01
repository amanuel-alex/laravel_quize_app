<x-layout>
   <div class="max-w-5xl mx-auto py-12 px-4">
       
       
       <div id="references-container" class="rounded-md  space-y-8 bg-slate-200 text-slate-100" >
           <!--  dynamically inserted -->
       </div>

       <div class="flex justify-around mt-16 ">
           <button id="previous" class=" hover:bg-slate-400 bg-blue-500 text-white px-4 py-2 rounded-lg" disabled>Previous</button>
           <button id="next" class="hover:bg-slate-400 bg-blue-500 text-white px-4 py-2  rounded-lg">Next</button>
       </div>
   </div>

   <script>
       let currentReferenceIndex = 0;
       let references = [];

       // Fetch references when the page loads
       window.onload = function() {
           fetchReferences();
       };

       // Fetch references from the backend API
       function fetchReferences() {
           fetch('/api/references')
               .then(response => response.json())
               .then(data => {
                   if (data.error) {
                       document.getElementById('references-container').innerHTML = data.error;
                   } else {
                       references = data.sections;  // Assuming 'sections' contains the references
                       displayReference(currentReferenceIndex);  // Display the first reference
                   }
               })
               .catch(error => {
                   console.error('Error fetching references:', error);
               });
       }

       // Display the current reference
       function displayReference(index) {
           if (index >= 0 && index < references.length) {
               const reference = references[index];
               const referenceHtml = `
                   <div class="reference">
                       <h2 class="text-2xl font-semibold">${reference.title}</h2>
                       <p class="text-gray-700">${reference.description}</p>
                   </div>
               `;

               // Insert the reference HTML into the references container
               document.getElementById('references-container').innerHTML = referenceHtml;

               // Enable/Disable Next/Previous buttons
               document.getElementById('previous').disabled = index === 0;
               document.getElementById('next').disabled = index === references.length - 1;
           }
       }

       // Go to the next reference
       document.getElementById('next').addEventListener('click', function() {
           if (currentReferenceIndex < references.length - 1) {
               currentReferenceIndex++;
               displayReference(currentReferenceIndex);
           }
       });

       // Go to the previous reference
       document.getElementById('previous').addEventListener('click', function() {
           if (currentReferenceIndex > 0) {
               currentReferenceIndex--;
               displayReference(currentReferenceIndex);
           }
       });
   </script>
</x-layout>
