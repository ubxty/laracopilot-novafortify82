<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Laravel Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2 sm:space-x-8">
                    <a href="{{ route('home') }}" class="text-xl sm:text-2xl font-bold">Laravel Portal</a>
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('dashboard') }}" class="bg-blue-700 px-3 py-2 rounded">Dashboard</a>
                        <a href="{{ route('dashboard.projects.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded transition">My Projects</a>
                        <a href="{{ route('opensource.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded transition">Open Source</a>
                    </div>
                </div>
                <div class="flex items-center space-x-2 sm:space-x-4">
                    <span class="text-blue-100 text-sm sm:text-base hidden sm:inline">Welcome, <strong>{{ session('user_name') }}</strong></span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-2 sm:px-4 py-2 rounded transition text-sm sm:text-base">
                            <i class="fas fa-sign-out-alt mr-1 sm:mr-2"></i><span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-6 sm:py-8">
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg shadow-lg p-6 sm:p-8 mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-2">Welcome back, {{ session('user_name') }}!</h1>
            <p class="text-blue-100 text-sm sm:text-base">Manage your projects and track your progress</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-gray-500 text-sm">Total Projects</div>
                    <div class="bg-blue-100 p-2 sm:p-3 rounded-lg">
                        <i class="fas fa-folder text-blue-600 text-lg sm:text-xl"></i>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-bold text-gray-800">{{ $totalProjects }}</div>
                <div class="text-xs sm:text-sm text-green-600 mt-2">
                    <i class="fas fa-arrow-up mr-1"></i>Active
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-gray-500 text-sm">Public Projects</div>
                    <div class="bg-green-100 p-2 sm:p-3 rounded-lg">
                        <i class="fas fa-globe text-green-600 text-lg sm:text-xl"></i>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-bold text-gray-800">{{ $publicProjects }}</div>
                <div class="text-xs sm:text-sm text-gray-500 mt-2">Visible to all</div>
            </div>

            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-gray-500 text-sm">Private Projects</div>
                    <div class="bg-purple-100 p-2 sm:p-3 rounded-lg">
                        <i class="fas fa-lock text-purple-600 text-lg sm:text-xl"></i>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-bold text-gray-800">{{ $privateProjects }}</div>
                <div class="text-xs sm:text-sm text-gray-500 mt-2">Only you can see</div>
            </div>

            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-gray-500 text-sm">Opensource</div>
                    <div class="bg-orange-100 p-2 sm:p-3 rounded-lg">
                        <i class="fas fa-code-branch text-orange-600 text-lg sm:text-xl"></i>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-bold text-gray-800">{{ $opensourceProjects }}</div>
                <div class="text-xs sm:text-sm text-gray-500 mt-2">Contributing</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6 mb-6 sm:mb-8">
            <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6">Quick Actions</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                <a href="{{ route('dashboard.projects.create') }}" class="flex items-center space-x-3 sm:space-x-4 bg-blue-50 hover:bg-blue-100 p-4 sm:p-6 rounded-lg transition">
                    <div class="bg-blue-600 text-white p-3 sm:p-4 rounded-lg">
                        <i class="fas fa-plus text-lg sm:text-xl"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-sm sm:text-base">New Project</div>
                        <div class="text-xs sm:text-sm text-gray-600">Create a new project</div>
                    </div>
                </a>

                <a href="{{ route('dashboard.projects.index') }}" class="flex items-center space-x-3 sm:space-x-4 bg-green-50 hover:bg-green-100 p-4 sm:p-6 rounded-lg transition">
                    <div class="bg-green-600 text-white p-3 sm:p-4 rounded-lg">
                        <i class="fas fa-folder-open text-lg sm:text-xl"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-sm sm:text-base">View Projects</div>
                        <div class="text-xs sm:text-sm text-gray-600">Manage your projects</div>
                    </div>
                </a>

                <a href="{{ route('opensource.index') }}" class="flex items-center space-x-3 sm:space-x-4 bg-purple-50 hover:bg-purple-100 p-4 sm:p-6 rounded-lg transition">
                    <div class="bg-purple-600 text-white p-3 sm:p-4 rounded-lg">
                        <i class="fas fa-code-branch text-lg sm:text-xl"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-sm sm:text-base">Open Source</div>
                        <div class="text-xs sm:text-sm text-gray-600">Browse contributions</div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Projects -->
        <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-6 gap-3">
                <h2 class="text-xl sm:text-2xl font-bold">Recent Projects</h2>
                <a href="{{ route('dashboard.projects.index') }}" class="text-blue-600 hover:text-blue-800 text-sm sm:text-base">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            @if($recentProjects->count() > 0)
                <div class="overflow-x-auto -mx-4 sm:mx-0">
                    <div class="inline-block min-w-full align-middle">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project</th>
                                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Tech Stack</th>
                                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-4 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($recentProjects as $project)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 sm:px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $project->title }}</div>
                                            <div class="text-xs sm:text-sm text-gray-500 sm:hidden">{{ Str::limit($project->tech_stack, 30) }}</div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 hidden sm:table-cell">
                                            <div class="flex flex-wrap gap-1">
                                                @foreach(array_slice(explode(',', $project->tech_stack), 0, 3) as $tech)
                                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ trim($tech) }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4">
                                            @if($project->is_public)
                                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                                    <i class="fas fa-globe mr-1"></i>Public
                                                </span>
                                            @else
                                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">
                                                    <i class="fas fa-lock mr-1"></i>Private
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 text-right text-sm">
                                            <a href="{{ route('dashboard.projects.edit', $project->id) }}" class="text-blue-600 hover:text-blue-800 mr-3">
                                                <i class="fas fa-edit"></i><span class="hidden sm:inline ml-1">Edit</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="text-center py-8 sm:py-12">
                    <i class="fas fa-folder-open text-gray-300 text-4xl sm:text-5xl mb-4"></i>
                    <p class="text-gray-500 mb-4 text-sm sm:text-base">You haven't created any projects yet</p>
                    <a href="{{ route('dashboard.projects.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg transition text-sm sm:text-base">
                        <i class="fas fa-plus mr-2"></i>Create Your First Project
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-8 sm:mt-12">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-xs sm:text-sm">
            <p>© {{ date('Y') }} Laravel Portal. All rights reserved.</p>
            <p class="mt-2">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="hover:underline text-blue-400">LaraCopilot</a></p>
        </div>
    </footer>
</body>
</html>
